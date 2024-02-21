#include <WiFi.h> 
#include <HTTPClient.h> 
#include <DHT.h>
#include <WiFiManager.h>
// DHT dht(26, DHT11);

String URL = "http://vincenzodiana.altervista.org/capolavoro/ventola.txt";

// const char* ssid = "Wiber_C2FC"; 
// const char* password = "annavincenzosalvatore"; 

// float temperature = 0; 
// float humidity = 0;

void setup() {
  pinMode(26, OUTPUT); //SET PIN G26
  //dht.begin();
  delay(2000);
  Serial.begin(9600); 
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
  Serial.print("payload : "); Serial.println(payload); 
  Serial.println("--------------------------------------------------");
  if(payload == "1")
  {
    digitalWrite(26, HIGH);  
    Serial.println("Ventola Accesa");
  }else
  {
    digitalWrite(26, LOW);
    Serial.println("Ventola SPENTA");  
  }
  // if(WiFi.status() != WL_CONNECTED) { 
  //   connectWiFi();
  // }
  // temperature = dht.readTemperature();
  // humidity = dht.readHumidity();
  // String postData = "temperature=" + String(temperature) + "&humidity=" + String(humidity); 
  // String postData = "scritta=ciao";
  // HTTPClient http; 
  // http.begin(URL);
  // http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  // int httpCode = http.POST(postData); 
  // String payload = http.getString(); 
  
  // Serial.print("URL : "); Serial.println(URL); 
  // Serial.print("Data: "); Serial.println(postData); 
  // Serial.print("httpCode: "); Serial.println(httpCode); 
  // Serial.print("payload : "); Serial.println(payload); 
  // Serial.println("--------------------------------------------------");
  //temperature = random(1,50); 
  //humidity = random(1,100);
  delay(1000); //ogni 60 secondi
}

bool connectWiFi() //access point
{
  WiFi.mode(WIFI_STA);
  WiFiManager wm;
  //wm.resetSettings();
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

// void connectWiFi() {
//   WiFi.mode(WIFI_OFF);
//   delay(1000);
//   //This line hides the viewing of ESP as wifi hotspot
//   WiFi.mode(WIFI_STA);
  
//   WiFi.begin(ssid, password);
//   Serial.println("Connecting to WiFi");
  
//   while (WiFi.status() != WL_CONNECTED) {
//     delay(500);
//     Serial.print(".");
//   }
    
//   Serial.print("connected to : "); Serial.println(ssid);
//   Serial.print("IP address: "); Serial.println(WiFi.localIP());
// }