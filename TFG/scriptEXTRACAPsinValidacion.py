import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import f1_score, recall_score, precision_score, accuracy_score
import numpy as np
import matplotlib.pyplot as plt

data = pd.read_csv('data.csv')

X = data.drop('EXTRACAP', axis=1)
y = data['EXTRACAP']
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TRBQ', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']

X_train_post = X_train[selected_features_post]
X_test_post = X_test[selected_features_post]

def train_and_evaluate_models(X_train, y_train, X_test, y_test):
    # Entrenar y evaluar los modelos
    lr_model = LogisticRegression(random_state=42, max_iter=1000)
    rf_model = RandomForestClassifier(random_state=42)

    lr_model.fit(X_train, y_train)
    rf_model.fit(X_train, y_train)

    lr_y_pred = lr_model.predict(X_test)
    rf_y_pred = rf_model.predict(X_test)

    lr_scores = {
        'f1': f1_score(y_test, lr_y_pred),
        'recall': recall_score(y_test, lr_y_pred),
        'precision': precision_score(y_test, lr_y_pred),
        'accuracy': accuracy_score(y_test, lr_y_pred),
    }
    rf_scores = {
        'f1': f1_score(y_test, rf_y_pred),
        'recall': recall_score(y_test, rf_y_pred),
        'precision': precision_score(y_test, rf_y_pred),
        'accuracy': accuracy_score(y_test, rf_y_pred),
    }

    print("Regresión logística:", lr_scores)
    print("Bosques aleatorios:", rf_scores)
    
    # Gráficos de barras para visualizar las métricas
    metrics = ['F1', 'Recall', 'Precision', 'Accuracy']
    lr_values = [lr_scores['f1'], lr_scores['recall'], lr_scores['precision'], lr_scores['accuracy']]
    rf_values = [rf_scores['f1'], rf_scores['recall'], rf_scores['precision'], rf_scores['accuracy']]

    x = np.arange(len(metrics))
    width = 0.3

    fig, ax = plt.subplots()
    rects1 = ax.bar(x - width/2, lr_values, width, label='Regresión logística')
    rects2 = ax.bar(x + width/2, rf_values, width, label='Bosques aleatorios')

    ax.set_ylabel('Valor')
    ax.set_title('Métricas de evaluación EXTRACAP')
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

print(f"Modelos para EXTRACAP (Postoperatorio):")
train_and_evaluate_models(X_train_post, y_train, X_test_post, y_test)
print("\n")