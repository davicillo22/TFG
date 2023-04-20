import pandas as pd
import pickle
import json
# Cargar los modelos entrenados
with open('lr_margen.pickle', 'rb') as f:
    lr_model = pickle.load(f)

with open('rf_margen.pickle', 'rb') as f:
    rf_model = pickle.load(f)

def predict_probabilities(model, patient_data):
    proba = model.predict_proba(patient_data)
    return proba[0][1]

# Datos de un nuevo paciente como un DataFrame con las mismas columnas que X_train_post
new_patient_post = pd.read_csv('dataPatient.csv')
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TRBQ', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
new_patient_post = new_patient_post[selected_features_post]
# Predicciones de probabilidad para ambos modelos
lr_probability = predict_probabilities(lr_model, new_patient_post)
rf_probability = predict_probabilities(rf_model, new_patient_post)

result = {
    "lr_probability": lr_probability,
    "rf_probability": rf_probability
}

print(json.dumps(result))