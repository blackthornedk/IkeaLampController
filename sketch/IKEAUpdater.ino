/*
 * Relay Shield - IKEA Updater
 * Turns on the relay, if the black button is pressed on the webpage.
 *
 * Relay Shield transistor closes relay when D1 is HIGH
 */
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <black@blackthorne.dk> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return Jacob V. Rasmussen
 * ----------------------------------------------------------------------------
 */

#include <ESP8266WiFi.h>
#include <Arduino.h>
#include <ArduinoJson.h>

const int relayPin = D1;
const long interval = 2000;  // pause for two seconds

const char* ssid     = "WIFIName";
const char* password = "WIFIPass";

const char* host = "example.com";
const char* url = "/ikea/?json=1";

void setup() {
  Serial.begin(9600);
  delay(10);

  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  pinMode(relayPin, OUTPUT);
}

void loop() {
  Serial.print("connecting to ");
  Serial.println(host);
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  // This will send the request to the server
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }

  bool found = false;
  int next = 0;
  
  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
    String line = client.readStringUntil('\r');
    line.trim();
    if (line.length() == 0) {
      found = true;
    }
    
    if (found) {
      next++;
      if (next == 3) {
        Serial.print(line);
      
        StaticJsonBuffer<200> jsonBuffer;
        JsonObject& root = jsonBuffer.parseObject(line);

        if (!root.success()) {
          Serial.println("parseObject() failed");
          return;
        }

        bool white = root["white"];
        bool black = root["black"];

        if (black) {
            digitalWrite(relayPin, HIGH); // turn on relay with voltage HIGH
        } else {
            digitalWrite(relayPin, LOW);  // turn off relay with voltage LOW
        }
      }
    }
  }
  
  Serial.println();
  Serial.println("closing connection");

  delay(interval);              // pause
}
