
docker build --rm --tag demo-bhratach --tag eu.gcr.io/cyberlytic-profiler/images/demo-bhratach .
gcloud docker -- push eu.gcr.io/cyberlytic-profiler/images/demo-bhratach
