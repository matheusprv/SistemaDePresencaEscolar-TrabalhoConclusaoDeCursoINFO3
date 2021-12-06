#include <iostream>
#include <ESP8266WiFi.h>
#ifndef STASSID
#define STASSID "Matheus"  //Nome da rede WiFi
#define STAPSK  "estrelar" //Senha da rede WiFi
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "192.168.1.13"; //Conexão IP do computador

int repeticoes =0;

#define verde 5
#define vermelho 4

void setup() {
  pinMode(verde, OUTPUT);
  pinMode(vermelho, OUTPUT);
  Serial.begin(9600);

  //Conectando no WiFi
  Serial.println();
  Serial.println();
  Serial.print("Conectando com a rede");

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado");
  Serial.println("Endereço IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  repeticoes += 1;
  //////////////////////////////
  //
  //
  //
  //Lógica da leitura dos RFID's
  //
  //
  //
  //////////////////////////////

  
  static bool wait = true;

  Serial.print("Conectando com ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(80);

  //Conectadno com o Servidor
  const int httpPort = 80;
  WiFiClient client;
  if (!client.connect(host, httpPort)) {
    Serial.println("Falha na conexão");
    delay(3000);
    return;
  }
  
  //Enviando dados para o servidor
  String enderecoIP = String(host);
  client.println(String("GET http://"+enderecoIP+"//TCC-2/php_arduino/enviarDadosArduino.php?")+
                        ("matricula=")+ 11 +
                        " HTTP/1.1\r\n" +
                        "Host: " + host + "\r\n" + 
                        "Connection: close\r\n\r\n");

  // wait for data to be available
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Tempo de envio excedido. Tentando novamente em 10 segundos");
      client.stop();
      delay(10000);
      return;
    }
  }

  // Exibir a resposta do servidor sobre os inserts
  Serial.println("Recebendo resposta do servidor: ");
  while (client.available()) {
    //char ch = static_cast<char>(client.read());
    //string ch = static_cast<string>(client.read());
    //Serial.print(ch);

    String line = client.readStringUntil('\r');
    if(line.indexOf("sucesso") != -1){
      digitalWrite(verde, HIGH);
      Serial.println("Sucesso");
    }
    if(line.indexOf("erro") != -1){
      digitalWrite(vermelho, HIGH);
      Serial.println("Erro");
    }
  }

  // Fechar conexão
  Serial.println();
  Serial.println("Conexão fechada");
  client.stop();

  delay(30000);
  digitalWrite(vermelho, LOW);
  digitalWrite(verde, LOW);

}
