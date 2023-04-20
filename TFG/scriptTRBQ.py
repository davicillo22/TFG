import pandas as pd
from sklearn.model_selection import train_test_split, cross_val_score
from sklearn.linear_model import LinearRegression
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error, r2_score, accuracy_score, recall_score, make_scorer
import numpy as np
import matplotlib.pyplot as plt

data = pd.read_csv('data.csv')

X = data.drop('TRBQ', axis=1)
y = data['TRBQ']
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Para las variables objetivo que requieren las caracter�sticas PreOperatorias
selected_features_pre = ['EDAD', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'PSAPRE', 'PSALT', 'TDUPPRE', 'ECOTR', 'GLEASON1_1', 'GLEASON1_2', 'GLEASON1_3', 'GLEASON1_4', 'GLEASON1_5', 'NCILPOS_1', 'NCILPOS_2', 'NCILPOS_3', 'BILAT', 'PORCENT', 'IPERIN', 'TNM1_1', 'TNM1_2','TNM1_3','TCIR']
X_train_pre = X_train[selected_features_pre]
X_test_pre = X_test[selected_features_pre]

# Para las variables objetivo que requieren las caracter�sticas PostOperatorias
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
X_train_post = X_train[selected_features_post]
X_test_post = X_test[selected_features_post]

def train_and_evaluate_models(X, y):
    # Umbral para convertir las predicciones en clases binarias
    threshold = 0.5
    
    # Regresión lineal
    lr_model = LinearRegression()
    
    # Árboles aleatorios
    rf_model = RandomForestRegressor(random_state=42)
    
    # Métricas de evaluación personalizadas para usar en la validación cruzada
    def binary_accuracy(y_true, y_pred):
        y_classes = (y_pred >= threshold).astype(int)
        return accuracy_score(y_true, y_classes)
    
    def binary_recall(y_true, y_pred):
        y_classes = (y_pred >= threshold).astype(int)
        return recall_score(y_true, y_classes)

    binary_accuracy_scorer = make_scorer(binary_accuracy)
    binary_recall_scorer = make_scorer(binary_recall)

    # Utilizar la validación cruzada para obtener las métricas de evaluación
    lr_scores = cross_val_score(lr_model, X, y, cv=5, scoring=make_scorer(mean_squared_error))
    rf_scores = cross_val_score(rf_model, X, y, cv=5, scoring=make_scorer(mean_squared_error))
    lr_accuracy_scores = cross_val_score(lr_model, X, y, cv=5, scoring=binary_accuracy_scorer)
    rf_accuracy_scores = cross_val_score(rf_model, X, y, cv=5, scoring=binary_accuracy_scorer)
    lr_recall_scores = cross_val_score(lr_model, X, y, cv=5, scoring=binary_recall_scorer)
    rf_recall_scores = cross_val_score(rf_model, X, y, cv=5, scoring=binary_recall_scorer)
    lr_r2_scores = cross_val_score(lr_model, X, y, cv=5, scoring='r2')
    rf_r2_scores = cross_val_score(rf_model, X, y, cv=5, scoring='r2')
    
    # Calcular las métricas medias de la validación cruzada
    lr_rmse = np.sqrt(lr_scores.mean())
    rf_rmse = np.sqrt(rf_scores.mean())
    lr_accuracy = lr_accuracy_scores.mean()
    rf_accuracy = rf_accuracy_scores.mean()
    lr_recall = lr_recall_scores.mean()
    rf_recall = rf_recall_scores.mean()
    lr_r2 = lr_r2_scores.mean()
    rf_r2 = rf_r2_scores.mean()
    
    print("Regresión lineal - RMSE:", lr_rmse, "R2:", lr_r2,  "Accuracy:", lr_accuracy, "Recall:", lr_recall)
    print("Árboles aleatorios - RMSE:", rf_rmse, "R2:", rf_r2, "Accuracy:", rf_accuracy, "Recall:", rf_recall)
    # Gráficos de barras para visualizar las métricas
    metrics = ['RMSE',  'R2', 'Accuracy', 'Recall']
    lr_values = [lr_rmse, lr_r2, lr_accuracy, lr_recall]
    rf_values = [rf_rmse, rf_r2, rf_accuracy, rf_recall]

    x = np.arange(len(metrics))
    width = 0.3

    fig, ax = plt.subplots()
    rects1 = ax.bar(x - width/2, lr_values, width, label='Regresión lineal')
    rects2 = ax.bar(x + width/2, rf_values, width, label='Árboles aleatorios')

    ax.set_ylabel('Valor')
    ax.set_title('Métricas de evaluación (Validación cruzada)')
    ax.set_xticks(x)
    ax.set_xticklabels(metrics)
    ax.legend()

    # Función para agregar anotaciones de texto a las barras del gráfico
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


print(f"Modelos para TRBQ (Preoperatorio):")
train_and_evaluate_models(X_train_pre, y_train)
    
print(f"Modelos para TRBQ (Postoperatorio):")
train_and_evaluate_models(X_train_post, y_train)
print("\n")
