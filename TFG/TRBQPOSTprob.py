import pandas as pd
import pickle
import json
# Cargar los modelos entrenados
with open('cph_post.pickle', 'rb') as f:
    cphDic = pickle.load(f)
    cph=cphDic['model']

def predict_rbq_probabilities(model, patient_data):
    survival_5_years = model.predict_survival_function(patient_data, times=[60])
    survival_10_years = model.predict_survival_function(patient_data, times=[120])

    rbq_5_years = 1 - survival_5_years.iloc[0, 0]
    rbq_10_years = 1 - survival_10_years.iloc[0, 0]

    return rbq_5_years, rbq_10_years

# Datos de un nuevo paciente como un DataFrame con las mismas columnas que X_train_pre y X_train_post
new_patient_post = pd.read_csv('dataPatient.csv')
selected_features_post = ['EDAD', 'PSAPRE', 'PSALT', 'TDUPPRE','VOLUMEN', 'PSAPOS', 'TDUPLI', 'PSAFIN', 'TSEGUI', 'CAPRA_S', 'OBESO_0', 'OBESO_1', 'OBESO_2', 'OBESO_3', 'HTA', 'DM', 'TABACO_0', 'TABACO_1', 'TABACO_2', 'TABACO_3', 'TABACO_4', 'TABACO_5', 'HEREDA', 'TACTOR_1', 'TACTOR_2', 'TACTOR_3', 'ECOTR', 'GLEASON2_1', 'GLEASON2_2', 'GLEASON2_3', 'GLEASON2_4', 'GLEASON2_5', 'BILAT2', 'LOCALIZ_1', 'LOCALIZ_2', 'LOCALIZ_3', 'LOCALIZ_4', 'MULTIFOC', 'VVSS', 'IPERIN2', 'PINAG', 'MARGEN', 'TNM2_1', 'TNM2_2', 'TNM2_3', 'TNM2_5', 'RTPADYU', 'FALLEC', 'PTEN_0', 'PTEN_1', 'PTEN_2', 'ERG', 'KI_67_0', 'KI_67_1', 'KI_67_2', 'SPINK1', 'C_MYC','TCIR','TFIN']
new_patient_post = new_patient_post[selected_features_post]

rbq_5_years_post, rbq_10_years_post = predict_rbq_probabilities(cph, new_patient_post)

result = {
    "rbq_5_years_post": rbq_5_years_post,
    "rbq_10_years_post": rbq_10_years_post,

    "concordance": cphDic['concordancia'],
    "partialAIC": cphDic['partialAIC'],
    "logRatio": cphDic['logRatio']
}

print(json.dumps(result))