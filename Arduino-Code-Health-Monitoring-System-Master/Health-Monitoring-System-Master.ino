#include <Wire.h>
#include<LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x3F, 16, 2);
#include "MAX30100_PulseOximeter.h"
#define REPORTING_PERIOD_MS     5000
PulseOximeter pox;
uint32_t tsLastReport = 0;
int pulses, spo2, analogValue;
float voltage, tC;
const int LM35Pin = A0;
//String tData;
void onBeatDetected()
{
  //Serial.println("Finger Detected");
}

void setup()
{
  Serial.begin(115200);
  pinMode(A0, INPUT);
  lcd.init();
  lcd.backlight();
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("HEALTH MONITOR");
  lcd.setCursor(0, 1);
  lcd.print("PULSE-SpO2-TEMP");
  delay(3000);
  //  Serial.print("Initializing pulse oximeter..");
  if (!pox.begin()) {
    //  Serial.println("FAILED");
    for (;;);
  } else {
    //Serial.println("SUCCESS");
  }
  pox.setIRLedCurrent(MAX30100_LED_CURR_7_6MA);
  pox.setOnBeatDetectedCallback(onBeatDetected);
}

void loop()
{
  pox.update();
  if (millis() - tsLastReport > REPORTING_PERIOD_MS) {
    // Sense Temperature
    voltage = analogRead(LM35Pin) * 3.3 / 1024.0;
    tC = voltage * 100.0;
    //tData = (String)tC + " " + (char)223 + "C";
    //Serial.print("Heart rate:");
    pulses = pox.getHeartRate();
    spo2 = pox.getSpO2();
    if (pulses > 50 && spo2 > 50)
    {
      Serial.print(pulses);
      Serial.print(",");
      Serial.print(spo2);
      Serial.print(",");
      Serial.print(tC);
    }
    tsLastReport = millis();
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("PULSES SPO2 TEMP");
    lcd.setCursor(0, 1);
    lcd.print(pulses);
    lcd.setCursor(6, 1);
    lcd.print(spo2);
    lcd.setCursor(11, 1);
    lcd.print(tC);
  }
}
