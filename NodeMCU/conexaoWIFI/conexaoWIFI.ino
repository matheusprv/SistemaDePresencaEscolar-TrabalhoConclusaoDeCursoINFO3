/*
    This sketch establishes a TCP connection to a "quote of the day" service.
    It sends a "hello" message, and then prints received data.
*/

#include <ESP8266WiFi.h>

const char* ssid     = "Matheus";
const char* password = "estrelar";





void setup() {
  pinMode(LED_BUILTIN, OUTPUT);
  digitalWrite(LED_BUILTIN, LOW);
  Serial.begin(9600);

  //Conectando ao WIFI
  Serial.println();
  Serial.println("Conectando ao WiFi");

  WiFi.begin(ssid, password);

  Serial.println();
  Serial.println("Conectando");

  while( WiFi.status() != WL_CONNECTED ){
    delay(500);
    Serial.print("."); 
    digitalWrite( LED_BUILTIN , HIGH);
    delay(500);
    digitalWrite( LED_BUILTIN , LOW);
    delay(500);
  }

  digitalWrite( LED_BUILTIN , HIGH);
  delay(10000);
  Serial.println();

  Serial.println("Wifi Connecteda com sucesso!");
  Serial.print("NodeMCU IP Address : ");
  Serial.println(WiFi.localIP() );

  
}

void loop() {
  
    
}
