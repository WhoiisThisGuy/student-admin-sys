#!/bin/sh

echo " -- Certification -- "

CERT_C=${CERT_SS_C:-HU}
CERT_ST=${CERT_SS_ST:-Osool}
CERT_L=${CERT_SS_L:-Osool}
CERT_O=${CERT_SS_O:-Osool}
CERT_CN=${CERT_SS_CN:-osool.osool}


echo "Creating self signed cert with the following data:"
echo "/C=${CERT_C:-HU}/ST=${CERT_ST:-HU}/L=${CERT_L:-HU}/O=${CERT_C:-HU}/CN=${CERT_CN:-HU}"

if [ -d "/certs/" ]; then
mkdir -p /certs/
fi

if [ ! -f "/certs/privkey.pem" ]; then
  openssl req -x509 -newkey rsa:4096 -keyout /certs/privkey.pem -out /certs/fullchain.pem -subj "/C=${CERT_C:-HU}/ST=${CERT_ST:-HU}/L=${CERT_L:-HU}/O=${CERT_C:-HU}/CN=${CERT_CN:-HU}" -nodes
fi

if [ ! -f "/certs/dhparam.pem" ]; then
  openssl dhparam -out /certs/dhparam.pem 2048
fi

echo " -- Certification Initialize Finished -- "
