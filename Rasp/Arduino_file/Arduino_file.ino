#include <SoftwareSerial.h>

SoftwareSerial mySerial(3, 4); // RX, TX

void setup()  {
  Serial.begin(9600);
  mySerial.begin(9600);
}

void loop() {
  bool ready = false;
  if (mySerial.available()) {
    char c = mySerial.read();
    Serial.print(c);
  }
}
