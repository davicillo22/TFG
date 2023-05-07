import pandas as pd
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import f1_score, recall_score, precision_score, accuracy_score, make_scorer
import numpy as np
import matplotlib.pyplot as plt
import pickle

data = pd.read_csv('data.csv')

X = data.drop('EXTRACAP', axis=1)
y = data['EXTRACAP']
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Para las variables objetivo que requieren las caracteristicas PostOperatorias
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TRBQ', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
X_train_post = X_train[selected_features_post]
X_test_post = X_test[selected_features_post]

def train_and_evaluate_models(X, y):
    # Modelos de clasificación
    lr_model = LogisticRegression(random_state=42, max_iter=1000)
    rf_model = RandomForestClassifier(random_state=42)
    
    # Métricas de evaluación
    scorers = {'f1': make_scorer(f1_score), 'recall': make_scorer(recall_score),
               'precision': make_scorer(precision_score), 'accuracy': make_scorer(accuracy_score)}

    lr_scores = {}
    rf_scores = {}
    
    for metric, scorer in scorers.items():
        lr_scores[metric] = cross_val_score(lr_model, X, y, cv=5, scoring=scorer).mean()
        rf_scores[metric] = cross_val_score(rf_model, X, y, cv=5, scoring=scorer).mean()
    
    print("Regresión logística:", lr_scores)
    print("Árboles aleatorios:", rf_scores)


    # Entrena los modelos antes de guardarlos
    lr_model.fit(X, y)
    rf_model.fit(X, y)

    # Guardar los modelos entrenados
    with open('lr_extracap.pickle', 'wb') as f:
        pickle.dump(lr_model, f)

    with open('rf_extracap.pickle', 'wb') as f:
        pickle.dump(rf_model, f)

print(f"Modelos para EXTRACAP (Postoperatorio):")
train_and_evaluate_models(X_train_post, y_train)
print("\n")

