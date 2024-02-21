#include <WiFi.h> 
#include <HTTPClient.h> 
#include <DHT.h>
#include <WiFiManager.h>
#include <ArduinoJson.h>

#define RXD2 16  //RXD
#define TXD2 17  //TXD

String URL = "http://vincenzodiana.altervista.org/capolavoro/output.json";

void setup() {
  pinMode(26, OUTPUT); //SET PIN G26
  //dht.begin();
  delay(2000);
  Serial.begin(9600);  // Inizializza la porta seriale predefinita del ESP32
  Serial1.begin(9600, SERIAL_8N1, RXD2, TXD2);  // Inizializza una seconda porta seriale su specifici pin RX e TX 
  connectWiFi();
}

void loop() {
  if(!connectWiFi())
  {
    Serial.println("Errore di connessione... riprova");
    connectWiFi();    
  }
  HTTPClient http;
  http.begin(URL);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  int httpCode = http.GET(); 
  String payload = http.getString(); 
  
  Serial.print("URL : "); Serial.println(URL); 
  Serial.print("httpCode: "); Serial.println(httpCode); 
  
  //lettura dati json
  StaticJsonDocument<256> doc;  // Imposta la dimensione del documento in base alle tue esigenze
  DeserializationError error = deserializeJson(doc, payload);
  if (error) 
  {
    Serial.print("Errore durante il parsing JSON: ");
    Serial.println(error.c_str());
  } else {
    // Accesso ai dati
    float temperatura = doc["temperatura"];
    int ventola = doc["ventola"];
    
    // Stampare i dati
    Serial.print("Temperatura: ");
    Serial.println(temperatura);
    Serial.print("Ventola: ");
    Serial.println(ventola);
  }
  
  Serial.println("--------------------------------------------------");
  Serial1.println(payload);
  Serial.flush();  // invia i dati prima di accumulare il buffer
  delay(1000); //ogni 60 secondi
}

bool connectWiFi() //access point
{
  WiFi.mode(WIFI_STA);
  WiFiManager wm;
  bool res;
  res = wm.autoConnect("AutoConnectAP", "password"); 
    if(!res) {
        Serial.println("Errore di connessione");
        return false;
    } 
    else {    
        Serial.println("Sei connesso");
        return true;
    }
}

