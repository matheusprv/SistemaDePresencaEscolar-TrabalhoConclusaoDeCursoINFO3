#include <iostream>
#include <ESP8266WiFi.h>
#ifndef STASSID
#define STASSID "Matheus"  //Nome da rede WiFi
#define STAPSK  "estrelar" //Senha da rede WiFi

#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 15
#define RST_PIN 0
 
MFRC522 mfrc522(SS_PIN, RST_PIN); // Instance of the class

MFRC522::MIFARE_Key key; 

byte nuidPICC[4];
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "192.168.1.11"; //Conexão IP do computador


//Acao = 0 -> Salvar presenca no banco de dados
//Acao = 1 -> Salvar UID de um cartão no banco
//Acao = 2 -> Salvar presença a partir da leitura do UID
int acao = 2;

// 0 para NÃO e 1 para SIM
int possuiDadosParaEnviar = 0;

//UID do cartão RFID
unsigned long hex_num;

String enderecoIP = String(host);
String cliente; // O que será enviado para o servidor fazer


//#define verde 5
//#define vermelho 4

void setup() {
  //pinMode(verde, OUTPUT);
  //pinMode(vermelho, OUTPUT);
  Serial.begin(9600);
  SPI.begin(); // Init SPI bus
  
  mfrc522.PCD_Init(); // Init MFRC522 

  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

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

  //Verificando a acao e preparando dados para mandar para o servidor
  if(acao==0){
    cliente = String ("GET http://"+enderecoIP+"//TCC-2/php_arduino/enviarDadosArduino.php?")+
                        ("matricula=")+ 11 +
                        " HTTP/1.1\r\n" +
                        "Host: " + host + "\r\n" + 
                        "Connection: close\r\n\r\n";
    possuiDadosParaEnviar = 1;
  }
  //LER UID do arduino para salvar no banco de dados
  else{
    //Verifica se há algum cartão para ler
    if (mfrc522.PICC_IsNewCardPresent()) {
      if ( mfrc522.PICC_ReadCardSerial()) { 
        hex_num =  mfrc522.uid.uidByte[0] << 24;
        hex_num += mfrc522.uid.uidByte[1] << 16;
        hex_num += mfrc522.uid.uidByte[2] <<  8;
        hex_num += mfrc522.uid.uidByte[3];
        mfrc522.PICC_HaltA(); // Stop reading
        Serial.print("Cartão detectado, UID: ");
        Serial.println(hex_num);

        if(acao==1){
          cliente = String ("GET http://"+enderecoIP+"//TCC-2/php_arduino/salvarUIDcartao.php?")+
                           ("uid=")+ hex_num +
                           " HTTP/1.1\r\n" +
                           "Host: " + host + "\r\n" + 
                           "Connection: close\r\n\r\n";
        }
        else{
          cliente = String ("GET http://"+enderecoIP+"//TCC-2/php_arduino/presencaLeituraRFID.php?")+
                        ("uid=")+ hex_num +
                        " HTTP/1.1\r\n" +
                        "Host: " + host + "\r\n" + 
                        "Connection: close\r\n\r\n";
        }
        
        possuiDadosParaEnviar = 1;
      }
    }
  }

  //Conexao com o servidor
  if(possuiDadosParaEnviar == 1){
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
    client.println(cliente);
  
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
      String line = client.readStringUntil('\r');
      if(line.indexOf("sucesso") != -1){
        //digitalWrite(verde, HIGH);
        Serial.println("Sucesso");
      }
      if(line.indexOf("erro") != -1){
        //digitalWrite(vermelho, HIGH);
        Serial.println("Erro");
      }
    }
  
    // Fechar conexão
    Serial.println();
    Serial.println("Conexão fechada");
    client.stop();
  
    //delay(30000);
    //digitalWrite(vermelho, LOW);
    //digitalWrite(verde, LOW);
  
    possuiDadosParaEnviar =0;
  }

}
