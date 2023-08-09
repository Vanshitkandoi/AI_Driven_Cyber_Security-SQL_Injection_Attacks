from fastapi import FastAPI, HTTPException
from pydantic import BaseModel

app = FastAPI()
from model import Check_is_sql

# pydantic models
class Input(BaseModel):
 sqli: str
class Result(BaseModel):
 result: int

@app.get("/ping")
def pong():
    return {"ping": "pong!"}

@app.post("/predict", response_model=Result, status_code=200)
def get_prediction(payload: Input):
 sql_input = payload.sqli
 prediction = Check_is_sql(sql_input)
# if not prediction:
# raise HTTPException(status_code=400, detail="Model not found.")
 response_object = {"result":prediction}
 return response_object