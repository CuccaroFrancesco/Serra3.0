// this sample code provided by www.programmingboss.com
// void setup() {
//   Serial.begin(9600);
// }
// void loop() {
//   Serial.println("Hello Boss");
//   delay(1500);
//   if(Serial.available())
//   {
//     Serial.write(Serial.read());
//   }
// }
#include <SoftwareSerial.h>

SoftwareSerial espSerial(2, 3);  // RX, TX. Sostituisci con i pin effettivi

void setup() {
    Serial.begin(9600);  // Inizializza la porta seriale predefinita del Arduino UNO
    espSerial.begin(9600);  // Inizializza la porta seriale virtuale per la comunicazione con l'ESP32
    pinMode(13, OUTPUT);
}

void loop() {
    char j;  // Inizializza j a '0' all'avvio
    // Leggi dati dalla porta seriale virtuale (espSerial)
    while (espSerial.available() > 0) {
        char dato = espSerial.read();
        Serial.print("IL dato e: ");
        Serial.println(dato);

        if (dato == '1') {
            j = dato;
        } else if (dato == '0') {
            j = dato;
        }
    }

    if (j == '1') {
        Serial.println("ventola accesa");
        digitalWrite(13, HIGH);
    } else if (j == '0') {
        Serial.println("ventola spenta");
        digitalWrite(13, LOW);
    }

    delay(1000);
}

