FROM python:bookworm

RUN pip install mysqlclient
WORKDIR /schema
CMD ["python", "run.py"]
