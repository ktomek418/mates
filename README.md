# Aplikacja do Organizowania wydarzeń

#1. Ekran startowy – logowanie.

![](RackMultipart20220203-4-1s6yaho_html_39a63967dc08e0e2.png)

Zawiera 2 pola input – na email oraz na hasło.

W przypadku błędnego logowania nad polem email wyświetla się odpowiedni komunikat.

W przypadku poprawnego logowania zostaniemy przekierowani na ekran projektów użytkownika.

W przypadku kliknięcia przycisku „Rejestracja&quot; zostaniemy przekierowani do ekranu rejestracji.

#2. Ekran rejestracji.

![](RackMultipart20220203-4-1s6yaho_html_8c74002160743792.png)

Zawiera 4 pola input – na nazwę użytkownika, email, hasło, oraz powtórzone hasło.

W przypadku wpisania błędnych danych, pole email podświetli się na czerwono.

W przypadku wpisania różnych haseł, pole hasło podświetli się na czerwono..

W przypadku próby rejestracji użytkownika, którego email jest już w bazie użytkownik dostanie komunikat nad polem email.

W przypadku poprawnej rejestracji użytkownik zostanie przeniesiony na stronę logowania.

#3. Panel nawigacji.

![](RackMultipart20220203-4-1s6yaho_html_4f24cbb3dd770d2b.png)

Zawiera 5 przycisków.

Przycisk „Zaplanowane&quot; - przenosi użytkownika do strony z wydarzeniami do których jest on przypisany

Przycisk „Wydarzenia&quot; - przenosi użytkownika do strony z wydarzeniami, które są organizowane przez innych użytkowników

Przycisk „Zaproszenia&quot; - przenosi użytkownika do strony, w której użytkownik może zarządzać wysłanymi przez siebie zaproszeniami
oraz aplikacjami innych użytkownikó do wydarzeń użytkownika

Przycisk „Ustawienia&quot; - przenosi użytkownika do jego profilu

Przycisk „Wyloguj&quot; - przenosi użytkownika do strony logowania i kończy jego sesje

#4. Ekran z wydarzeniami użytkownika.

![](RackMultipart20220203-4-1s6yaho_html_4f24cbb3dd770d2b.png)

Zawiera przycisk „Nowe wydarzenie&quot;, który otwiera kreator wydarzeń

Zawiera pasek wyszukiwań, które pozwala przeszukiwać wydarzenia użytkownika po słowie kluczowym

Zawiera Wydarzenia, które są organizowane przez użytkownika oraz wydarzenia do których użytkownik
dołączył jako uczestnik.

Każde wydarzenie jest opisane poprzez: Zdjęcie, liczbę uczestników, lokalizacje, date wydarzenia, czas trwania wydarzenia
oraz opis wydarzenia.

Do każdego wydarzenia dołączone są 1-2 przyciski w zależności od tego czy użytkownik jest organizatorem
czy tylko uczestnikiem wydarzenia.

Organizator posiada 2 przyciski:

przycisk „Edytuj&quot;, który otwiera edytor wydarzenia

przycisk „Anuluj&quot;, który anuluje wydarzenie

Uczesntnik posiada 1 przycisk:

przycisk „Wycofaj się &quot;, który wypisuje uczestnika z wydarzenia

#5. Ekran z publicznymi wydarzeniami.

![](RackMultipart20220203-4-1s6yaho_html_140cd98c470ee9dc.png)

Różni się od poprzedniego tym, że zawiera wszystkie wydarzerzenia, które posiadają wolne miejsca
oraz użytkownik do nich jeszcze nie dołączył.

Pasek wyszukiwań pozwala tak samo wyszukiwać wydarzenia po słowie kluczowym, ale tym razem
wyszukiwanie odbywa się w publicznych wydarzeniach.

Wydarzenie posiada tym razem 1 przycisk:

Przycisk „Dołącz&quot;, który wysyła do organizatora wydarzenia aplikacje z chęcią uczestnictwa w wydarzeniu
przez użytkownika.

Użytkownik z rolą admina posiada dodatkowo przycisk:

Przycisk „Skasuj&quot;, który pozwala skasować publiczne wydarzenie


#6. Kreator oraz edytor wydarzenia.

![](RackMultipart20220203-4-1s6yaho_html_5ae493da7800523d.png)

Posiada 7 inputów:

* Tytuł naszego wydarzenia(nie może być puste)
* Liczbę poszukiwanych osób (musi być wieksza od 1)
* Lokalizacja wydarzenia 
* Date wydarzenia(Nie może być przeszła)
* Długość wydarzenia
* Opis wydarzenia
* Zdjęcie dla naszego wydarzenia

Zawiera również dwa przyciski:

Przycisk „Anuluj&quot;, który zamyka edytor/kreator
Przycisk „Zapisz&quot;, który pozwala utworzyć wydarzenie jeśli wpisano poprawne dane

#7. Ekran z zaproszeniami.

![](RackMultipart20220203-4-1s6yaho_html_f4bb333b82b3c903.png)

Ekran zawiera informajce o wysłanych oraz otrzymanych aplikacjach na wydarzenia

Zawiera przycisk „Moje/otrzymane zgłoszenia&quot;, który pozwala przełączać się
między stroną z wysłanymi oraz stroną z otrzymanymi aplikacjami do wydarzeń.


Każda aplikacja zawiera informacje:

* nazwę użytkownika który wysłał lub otrzymał naszą aplikacje(naciśnięcie na tą nazwę)
pozwala otworzyć profil danego użytkownika.
* Informacje o tym jakiego wydarzenia dotyczny dane zgłoszenie
* zdjęcie profilowo użytkownika, który wysłał lub otrzymał naszą aplikacje

Do każdej aplikacji są dołączone 1-2 przyciski w zależności czy jest to aplikacja wysłana przez nas
czy otrzymana 

Jeśli jest to aplikacja wysłana przez nas, to posiada 1 przyciski:

Zawiera przycisk „Wycofaj zgłoszenie&quot;, który wycofuje nasze zgłoszenie

Jeśli jest to aplikacja otrzymana przez nas, to posiada 2 przyciski:

Zawiera przycisk „Odrzuć&quot;, które odrzuca zgłoszenie do naszego wydarzenia

Zawiera przycisk „Akceptuj&quot;, które akceptuje zgłoszenie i dodaje użytkownika do naszego wydarzenia


#8. Ekran z profilem użytkownika.

![](RackMultipart20220203-4-1s6yaho_html_f4bb333b82b3c903.png)

Zawiera informacje o użytkowniku, którego dotyczny takie jak:

*Nazwę użytkownia
*Imię użytkownika
*Nazwisko użytkownika
*Numer telefonu
*Opis użytkownika

Zawiera 1 przycisk, który różni się w zależności od tego czy profil należy do zalgowanego użytkownika

Jeśli tak to zawiera przycisk „Edytuj profil&quot;, które otwiera edytor, który pozwala nam edytować wcześniej wymienione dane

Jeśli profil nie należy do zalogowanego użytkownika to Zawiera przycisk „Zamknij podgląd&quot;, które zamyka stronę z profilem
