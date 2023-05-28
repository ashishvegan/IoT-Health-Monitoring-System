#include <Wire.h>
#include<ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
const char* ssid = "ESP8266";
const char* password = "12345678";
String pulses, spo2, temp,data;
const int wifi = D4, sync = D0;
void setup()
{
  Serial.begin(115200);
  pinMode(wifi, OUTPUT);
  pinMode(sync, OUTPUT);
  digitalWrite(wifi, HIGH);
  digitalWrite(sync, HIGH);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    digitalWrite(wifi, HIGH);
    delay(1000);
    digitalWrite(wifi, LOW);
    delay(1000);
  }
  digitalWrite(wifi, LOW);
}

void loop()
{
  if (Serial.available() > 0)
  {
    digitalWrite(sync, LOW);
    data = Serial.readString();
    Serial.println(data);
    pulses = getValue(data, ',', 0);
    spo2 = getValue(data, ',', 1);
    temp = getValue(data, ',', 2);
    HTTPClient http;
    http.begin("http://healthmonitoring.online/script.php?p=" + (String)pulses + "&t=" + (String)temp + "&s=" + spo2);
    http.GET();
    http.end();
    digitalWrite(sync, HIGH);
  }
  delay(100);
}
String getValue(String data, char separator, int index)
{
  int found = 0;
  int strIndex[] = {0, -1};
  int maxIndex = data.length() - 1;

  for (int i = 0; i <= maxIndex && found <= index; i++) {
    if (data.charAt(i) == separator || i == maxIndex) {
      found++;
      strIndex[0] = strIndex[1] + 1;
      strIndex[1] = (i == maxIndex) ? i + 1 : i;
    }
  }
  return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
}
