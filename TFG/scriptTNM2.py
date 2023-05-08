import pandas as pd
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import f1_score, recall_score, precision_score, accuracy_score, make_scorer
import numpy as np
import matplotlib.pyplot as plt
import pickle

data = pd.read_csv('data.csv')

# Combinar TNM2_1 y TNM2_2 en una nueva variable binaria
data['TNM2_1_2'] = data[['TNM2_1', 'TNM2_2']].any(axis=1)

X = data.drop(['TNM2_1', 'TNM2_2', 'TNM2_1_2'], axis=1)
y = data['TNM2_1_2']
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Para las variables objetivo que requieren las caracter�sticas PostOperatorias
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TRBQ', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
X_train_post = X_train[selected_features_post]
X_test_post = X_test[selected_features_post]

one_hot_groups_post = [
    ['OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3'],
    ['TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5'],
    ['TACTOR_1', 'TACTOR_2', 'TACTOR_3'],
    ['GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5'],
    ['LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4'],
    ['PTEN_0', 'PTEN_1', 'PTEN_2'],
    ['KI_67_0', 'KI_67_1', 'KI_67_2']
]

def remove_dummy_variable_trap(X, one_hot_groups):
    to_drop = [group[0] for group in one_hot_groups]
    return X.drop(to_drop, axis=1)

X_train_post = remove_dummy_variable_trap(X_train_post, one_hot_groups_post)
X_test_post = X_test_post[X_train_post.columns]

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


    # Entrena los modelos antes de guardarlos
    lr_model.fit(X, y)
    rf_model.fit(X, y)
    
    # Crear un diccionario que contenga el modelo y las métricas
    lr_results = {
        'model': lr_model,
        'precision': lr_scores['precision'],
        'recall': lr_scores['recall'],
        'f1_score': lr_scores['f1'],
        'accuracy': lr_scores['accuracy']
    }

    rf_results = {
        'model': rf_model,
        'precision': rf_scores['precision'],
        'recall': rf_scores['recall'],
        'f1_score': rf_scores['f1'],
        'accuracy': rf_scores['accuracy']
    }

    # Guardar los modelos entrenados
    with open('lr_tnm2.pickle', 'wb') as f:
        pickle.dump(lr_results, f)

    with open('rf_tnm2.pickle', 'wb') as f:
        pickle.dump(rf_results, f)
    
print(f"Modelos para TNM2_1 o TNM2_2 (Postoperatorio):")
train_and_evaluate_models(X_train_post, y_train)
print("\n")