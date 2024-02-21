
void setup()
{
  pinMode(13, OUTPUT);
  pinMode(12, OUTPUT);
}

void loop()
{
    digitalWrite(13, HIGH); //accendi led + ventola
    delay(5000); //aspetta 5 secondi
    digitalWrite(13, LOW); //spegni led + ventola
    digitalWrite(12, HIGH); //spegni led rosso e spegni la ventola
    delay(5000); //aspetta 5 secondi;
    digitalWrite(12, LOW); //spegni led rosso

}