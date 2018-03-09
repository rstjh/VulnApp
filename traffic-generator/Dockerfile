FROM python:2-stretch

COPY . /code/

RUN pip install --no-cache-dir -r /code/requirements.txt

CMD ["python2", "/code/src/generate-traffic.py", "random"]