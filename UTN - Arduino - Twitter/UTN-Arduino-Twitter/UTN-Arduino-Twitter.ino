/* Manejo de Red */
#include <Ethernet.h>//libreria ethernet
#include <SPI.h>//libreria ethernet
#include <Twitter.h>

/* Variables */
int analogZero,analogZero2; // Variables para pines analógicos que generan códigos al azar en Tweets
int trig = 7;
int echo = 8;
long tiempo = 0;
float distancia = 0;
int led = 2;
int umbral = 30;
String estado;
Twitter twitter("1268970124754681858-I01LkZhZXmOTbuay2qZYsmlj0PSiRY");
char msg[140]; // Mensaje para Twitter 

// Configuracion del Ethernet Shield
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFF, 0xEE}; // Direccion MAC
byte ip[] = { 192,168,0,233 }; // Direccion IP del Arduino
byte server[] = { 192,168,0,111 }; // Direccion IP del servidor
EthernetClient cliente;//objeto del ethernet

void setup() {
// put your setup code here, to run once:
  pinMode(led, OUTPUT); /* INPUT para entrada */
  pinMode(trig, OUTPUT);
  pinMode(echo, INPUT);
  Serial.println("Iniciando configuracion de Red...");
  Ethernet.begin(mac,ip);    
  Serial.begin(9600);
}

void loop() {
  // Lecturas de los pines A1 y A3 para generar códigos al azar y publicar en Twitter
  analogZero=analogRead(1);
  analogZero2=analogRead(3);
 
 //codigo para el sensor ultrasonico
  digitalWrite(trig, 0);//estabilizamos el sensor asignando un valor 0
  delayMicroseconds(5);//esperamos a la estabilizacion
  digitalWrite(trig, HIGH);//envio del sonido
  tiempo=pulseIn(echo, HIGH);//conteo de microsegundos, cambia a LOW cunado recibe el valor
  tiempo=tiempo/2;//el tiempo es doble debido a que tiene que mandar y recibir
  distancia=int(0.034*tiempo);//concatenacion a valor entero, despeje velocidad = 340m/s -> 0.034cm/microsegundo
  
  Serial.println("DISTANCIA = " + String(distancia) + "cm");

  
  if(distancia>0 && distancia<=30){
     Serial.println("Envio distancia menor a 30, conectando...");
    if (cliente.connect(server, 80)>0) {  // Conexion con el servidor(client.connect(server, 80)>0
      cliente.print("GET /UTN-Metodologia-SensorUltrasonico/proyecto/arduino.php?distancia="); // Enviamos los datos por GET
      cliente.print(distancia);
      cliente.println(" HTTP/1.0");
      cliente.println("User-Agent: Arduino 1.0");
      cliente.println();
      Serial.println("Envio con exito");
//////////////////////////////////////////////TWITTER///////////////////////////////////////////////
      // Se publica mensaje en Twitter, analogZero y analogZero2 publican números al azar para Twitter
      sprintf(msg,"El sensor detecto un objeto dentro de rango de 30cm %d%d.", analogZero, analogZero2);
      
      Serial.println("Enviando alerta a @Arduino-UTN ...");
      Serial.println(msg);//muestra el mensaje en el Puerto Serie
      
      if (twitter.post(msg)) {
        int status = twitter.wait();
        if (status == 200) {
          Serial.println("OK.");
        } else {
          Serial.print("failed : code ");
          Serial.println(status);
        }
      } else {
        Serial.println("connection failed.");
      }

      delay(10000); // Delay de un minuto para no hacer spam en Twitter       
    } else {
      Serial.println("Fallo en la conexion");
    }
    if (!cliente.connected()) {
      Serial.println("Desconectando");
      delay(1000);
    }
    cliente.stop();
    cliente.flush(); 
  }

  delay(2000); // Espero 2 segundos antes de tomar otra muestra
}
