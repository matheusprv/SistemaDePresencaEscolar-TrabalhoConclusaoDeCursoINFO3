/*
Porta RFID     Porta NodeMCU      GPIO da porta
   RST               D3                0
   SDA               D8                15  
   MOSI              D7  
   MISO              D6
   SCK               D5
   3.3V              3V
   GND               G

Link da biblioteca:
MRFC522-spi-i2c-uart-async
https://github.com/makerspaceleiden/rfid

*/

#include <iostream>
#include <ESP8266WiFi.h>
#ifndef STASSID
#define STASSID "Matheus"  //Nome da rede WiFi
#define STAPSK  "estrelar" //Senha da rede WiFi

#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 15
#define RST_PIN 0

#define LD_wifi 02 //Porta D4
#define LED_sucesso 16 //Porta D0

#define LD_1 04 //Porta D2
#define LD_2 05 //Porta D1
#define EA_1 A0
float tensao; 
float tensaoAnterior =0;
 
MFRC522 mfrc522(SS_PIN, RST_PIN); 
MFRC522::MIFARE_Key key; 
byte nuidPICC[4];
#endif

const char* ssid     = STASSID;
const char* password = STAPSK;

const char* host = "192.168.1.11"; //Conexão IP do computador

//Acao = 1 -> Salvar UID de um cartão no banco
//Acao = 2 -> Salvar presença a partir da leitura do UID
int acao = 2;

int possuiDadosParaEnviar = 0;  // 0 para NÃO e 1 para SIM

unsigned long numeroCartao; //Número do cartão RFID

String enderecoIP = String(host);
String cliente; // O que será enviado para o servidor fazer

void setup() {
  pinMode(LD_1, OUTPUT);
  pinMode(LD_2, OUTPUT);
  pinMode(LED_sucesso, OUTPUT);
  pinMode(LD_wifi, OUTPUT);

  Serial.begin(9600);
  Serial.println("Programa iniciado");
  SPI.begin(); // Init SPI bus
  
  mfrc522.PCD_Init(); // Init MFRC522 

  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

  //Conectando no WiFi
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
  Serial.print("Endereço IP: ");
  Serial.println(WiFi.localIP());
  Serial.println();
  digitalWrite(LD_wifi, 1);

  tensao = analogRead(EA_1);
  verificarAcao();

  Serial.println();
  Serial.println("Lendo cartões");
}

void loop() {
  //Verificando qual a ação desejada pelo potenciomentro
  tensao = analogRead(EA_1);
  if((tensao > tensaoAnterior+20) || (tensao < tensaoAnterior-20)){  
    verificarAcao();
  }

  //Verifica se há algum cartão para ler
  if (mfrc522.PICC_IsNewCardPresent()) {
    if ( mfrc522.PICC_ReadCardSerial()) { 
      numeroCartao =  mfrc522.uid.uidByte[0] << 24;
      numeroCartao += mfrc522.uid.uidByte[1] << 16;
      numeroCartao += mfrc522.uid.uidByte[2] <<  8;
      numeroCartao += mfrc522.uid.uidByte[3];
      mfrc522.PICC_HaltA(); // Parar de ler
      Serial.print("Cartão detectado: ");
      Serial.println(numeroCartao);
      Serial.print("Ação: ");
      Serial.println(acao);
      if(acao==1){
        cliente = String ("GET http://"+enderecoIP+"//TCC-2/php_arduino/salvarUIDcartao.php?")+
                         ("uid=")+ numeroCartao +
                         " HTTP/1.1\r\n" +
                         "Host: " + host + "\r\n" + 
                         "Connection: close\r\n\r\n";
      }
      else{
        cliente = String ("GET http://"+enderecoIP+"//TCC-2/php_arduino/presencaLeituraRFID.php?")+
                      ("uid=")+ numeroCartao +
                      " HTTP/1.1\r\n" +
                      "Host: " + host + "\r\n" + 
                      "Connection: close\r\n\r\n";
      }
      
      possuiDadosParaEnviar = 1;
    }
  }
  
  //Conexao com o servidor
  if(possuiDadosParaEnviar == 1){
    enviarDados();
  }
  
}



void verificarAcao(){
  if(tensao >= 512) {
      digitalWrite(LD_1, 0);
      digitalWrite(LD_2, 1);
      acao = 1;
    }
    else {
      digitalWrite(LD_1, 1);
      digitalWrite(LD_2, 0);
      acao = 2;
    }
    Serial.print("Ação: ");
    Serial.print(acao);
    if(acao==1){
      Serial.print(" Salvando novo cartão");
    }
    else{
      Serial.print(" Marcando presença para o aluno.");
    }
    Serial.println();
    tensaoAnterior = tensao;
    delay(1000);
}



void enviarDados(){
  //Serial.print("Conectando com ");
  //Serial.print(host);

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
  Serial.print("Recebendo resposta do servidor: ");
  while (client.available()) {
    String line = client.readStringUntil('\r');
    if(line.indexOf("sucesso") != -1){
      Serial.println("Sucesso");
      digitalWrite(LED_sucesso, HIGH);
      
    }
    if(line.indexOf("erro") != -1){
      Serial.println("Erro");
    }
  }
  Serial.println();

  client.stop();

  delay(5000);
  
  verificarAcao();
  Serial.println("Lendo cartões");
  digitalWrite(LED_sucesso, LOW);

  possuiDadosParaEnviar =0;

}
