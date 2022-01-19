#!/bin/bash

dir=$(dirname $0)
app=$(basename $0)

case $app in

deploy.sh)

  oc apply -f ${dir}/01-namespace.yaml
  oc apply -f ${dir}/02-sas.yaml
  oc apply -f ${dir}/10-whatcheese-web.yaml
  oc apply -f ${dir}/11-whatcheese-db.yaml
  oc apply -f ${dir}/12-whatcheese-api.yaml
  oc apply -f ${dir}/13-whatcheese-web-v2.yaml
  oc apply -f ${dir}/14-certificate-secret.yaml
  oc apply -f ${dir}/15-virtualserver.yaml
  ;;

undeploy.sh)
  oc delete -f ${dir}/15-virtualserver.yaml
  oc delete ns/whatcheese
  ;;

*)
  echo "Script should be called deploy.sh or undeploy.sh?"
  echo "Sorry buddy"
  exit 1
  ;;

esac
