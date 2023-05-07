import pandas as pd
import numpy as np
import pickle
import matplotlib.pyplot as plt
from lifelines import CoxPHFitter
from sklearn.model_selection import train_test_split

data = pd.read_csv('data.csv')

# Crear la columna 'RBQ' a partir de la columna 'TRBQ'
data['RBQ'] = (data['TRBQ'] > 0).astype(int)

X = data.drop('TRBQ', axis=1)
y = data['TRBQ']

# Modificar la columna 'TRBQ' para que tenga en cuenta 'TCIR' en el caso de no haber padecido el evento
data['TRBQ'] = np.where(data['RBQ'] == 1, data['TRBQ'], data['TCIR'])

# Crear un dataframe con las variables predictoras y las variables objetivo
data = data.rename(columns={'TRBQ': 'duration', 'RBQ': 'event'})

X_train, X_test = train_test_split(data, test_size=0.4, random_state=42)

# Para las variables objetivo que requieren las características PreOperatorias
selected_features_pre = ['EDAD', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'PSAPRE', 'PSALT', 'TDUPPRE', 'ECOTR', 'GLEASON1_1', 'GLEASON1_2', 'GLEASON1_3', 'GLEASON1_4', 'GLEASON1_5', 'NCILPOS_1', 'NCILPOS_2', 'NCILPOS_3', 'BILAT', 'PORCENT', 'IPERIN', 'TNM1_1', 'TNM1_2','TNM1_3','TCIR']

# Para las variables objetivo que requieren las características PostOperatorias
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']

X_train_pre = X_train[selected_features_pre + ['duration', 'event']]
X_test_pre = X_test[selected_features_pre + ['duration', 'event']]

X_train_post = X_train[selected_features_post + ['duration', 'event']]
X_test_post = X_test[selected_features_post + ['duration', 'event']]

def remove_dummy_variable_trap(X, one_hot_groups):
    to_drop = [group[0] for group in one_hot_groups]
    return X.drop(to_drop, axis=1)

one_hot_groups_pre = [
    ['OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3'],
    ['TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5'],
    ['TACTOR_1', 'TACTOR_2', 'TACTOR_3'],
    ['GLEASON1_1', 'GLEASON1_2', 'GLEASON1_3', 'GLEASON1_4', 'GLEASON1_5'],
    ['NCILPOS_1', 'NCILPOS_2', 'NCILPOS_3'],
    ['TNM1_1', 'TNM1_2', 'TNM1_3']
]

one_hot_groups_post = [
    ['OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3'],
    ['TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5'],
    ['TACTOR_1', 'TACTOR_2', 'TACTOR_3'],
    ['GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5'],
    ['LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4'],
    ['TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5'],
    ['PTEN_0', 'PTEN_1', 'PTEN_2'],
    ['KI_67_0', 'KI_67_1', 'KI_67_2']
]

X_train_pre = remove_dummy_variable_trap(X_train_pre, one_hot_groups_pre)
X_test_pre = X_test_pre[X_train_pre.columns]

X_train_post = remove_dummy_variable_trap(X_train_post, one_hot_groups_post)
X_test_post = X_test_post[X_train_post.columns]

def train_and_evaluate_survival_model(X_train, X_test):
    cph = CoxPHFitter(penalizer=0.1)
    cph.fit(X_train, duration_col='duration', event_col='event')

    cph.print_summary()

    # Calcular y mostrar la concordancia
    concordance = cph.score(X_test, scoring_method='concordance_index')
    print("Concordancia:", concordance)

    # Calcular el Partial AIC
    partial_aic = cph.AIC_partial_
    print("Partial AIC:", partial_aic)

    # Calcular el Log-likelihood ratio test
    ll_ratio_test = cph.log_likelihood_ratio_test()
    print("Log-likelihood ratio test:", ll_ratio_test)

    return cph

print("Entrenando modelo para TRBQ (Preoperatorio):")
cph_pre = train_and_evaluate_survival_model(X_train_pre, X_test_pre)

print("Entrenando modelo para TRBQ (Postoperatorio):")
cph_post = train_and_evaluate_survival_model(X_train_post, X_test_post)

# Guardar los modelos entrenados
with open('cph_pre.pickle', 'wb') as f:
    pickle.dump(cph_pre, f)

with open('cph_post.pickle', 'wb') as f:
    pickle.dump(cph_post, f)
