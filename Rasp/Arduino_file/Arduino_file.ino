#include <OneWire.h>
#include <DallasTemperature.h>

OneWire oneWire(2); //Bus One Wire sur la pin 2 de l'arduino
DallasTemperature sensors(&oneWire); //Utilistion du bus Onewire pour les capteurs
DeviceAddress sensorDeviceAddress; //Vérifie la compatibilité des capteurs avec la librairie

void setup() {
   Serial.begin(9600);              //Starting serial communication
   sensors.begin(); //Activation des capteurs
   sensors.getAddress(sensorDeviceAddress, 0); //Demande l'adresse du capteur à l'index 0 du bus
   sensors.setResolution(sensorDeviceAddress, 12); //Résolutions possibles: 9,10,11,12
                // Start up the library
}

void loop() {
  sensors.requestTemperatures(); // Send the command to get temperatures
  Serial.println(sensors.getTempCByIndex(0)); // Why "byIndex"? 
  delay(1000);                  // give the loop some break
}

 
