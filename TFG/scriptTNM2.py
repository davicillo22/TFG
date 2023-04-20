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
    
    # Gráficos de barras para visualizar las métricas
    metrics = ['F1', 'Recall', 'Precision', 'Accuracy']
    lr_values = [lr_scores['f1'], lr_scores['recall'], lr_scores['precision'], lr_scores['accuracy']]
    rf_values = [rf_scores['f1'], rf_scores['recall'], rf_scores['precision'], rf_scores['accuracy']]

    x = np.arange(len(metrics))
    width = 0.3

    fig, ax = plt.subplots()
    rects1 = ax.bar(x - width/2, lr_values, width, label='Regresión logística')
    rects2 = ax.bar(x + width/2, rf_values, width, label='Árboles aleatorios')

    ax.set_ylabel('Valor')
    ax.set_title('Métricas de evaluación TNM2 (Validación cruzada)')
    ax.set_xticks(x)
    ax.set_xticklabels(metrics)
    ax.legend()

    def autolabel(rects):
        for rect in rects:
            height = rect.get_height()
            ax.annotate('{:.2f}'.format(height),
                        xy=(rect.get_x() + rect.get_width() / 2, height),
                        xytext=(0, 3),
                        textcoords="offset points",
                        ha='center', va='bottom')

    autolabel(rects1)
    autolabel(rects2)

    plt.show()

    # Entrena los modelos antes de guardarlos
    lr_model.fit(X, y)
    rf_model.fit(X, y)
    
        # Guardar los modelos entrenados
    with open('lr_tnm2.pickle', 'wb') as f:
        pickle.dump(lr_model, f)

    with open('rf_tnm2.pickle', 'wb') as f:
        pickle.dump(rf_model, f)
    
print(f"Modelos para TNM2_1 o TNM2_2 (Postoperatorio):")
train_and_evaluate_models(X_train_post, y_train)
print("\n")