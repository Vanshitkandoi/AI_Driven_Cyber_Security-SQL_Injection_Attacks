from fastapi import FastAPI, HTTPException
from pydantic import BaseModel

app = FastAPI()
from model import  detectSQLI

# pydantic models
class Input(BaseModel):
    sqli: str
class Result(BaseModel):
    result: int

@app.get("/ping")
def pong():
    return {"ping": "pong!"}

@app.post("/main", response_model=Result, status_code=200)
def get_prediction(payload: Input):
    print(payload)
    sql_input = payload.sqli
    prediction = detectSQLI(sql_input)
    response_object = {"result":prediction}
    return response_object