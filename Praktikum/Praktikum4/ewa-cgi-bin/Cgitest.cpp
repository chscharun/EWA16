// CgiTest.cpp
// Beispiel zur CGI-Programmierung in C++
// Bernhard Kreling, 28.4.2011

#include <iostream>
#include <string>
using namespace std;

// Diese Klasse erleichtert den Zugriff auf die Umgebungsvariablen
class Environment {
public:
	Environment (char* envp[])
	: m_envp(envp)
	{}

	string get (string ENVname)
	{
		ENVname += "=";

		int i = 0;
		while (m_envp[i]!=NULL) {
			string envParam (m_envp[i]);
			if (envParam.find (ENVname)==0)
				return envParam.erase(0, ENVname.length());
			i++;
		}

		throw "Umgebungsvariable " + ENVname + " nicht gefunden";
	}
protected:
	char** m_envp;	// Array von Zeigern auf Umgebungsvariable
};

int main(int argc, char* argv[], char* envp[])
// envp ist ein Array von Zeigern auf nullterminierte Strings. Diese
// Strings enthalten die "Umgebungsvariablen" im Format "Name=Wert".
{
	// HTTP-Header für Antwort an Browser (verlangt 2 Zeilenendezeichen):
	cout << "Content-type: text/html" << endl << endl;

	// Anfang der HTML-Datei schreiben:
	cout << "<!DOCTYPE html>" << endl;
	cout << "<html lang=\"de\">" << endl;
	cout << "<head>" << endl;
	cout << "  <meta charset=\"iso-8859-1\"/>" << endl;
	cout << "  <title>CGI-Test</title>" << endl;
	cout << "</head>" << endl;
	cout << "<body>" << endl;

	try {
		// alle Umgebungsvariablen ausgeben:
		cout << "  <h3>Umgebungsvariable</h3>" << endl;
		cout << "  <p>" << endl;
		int i = 0;
		while (envp[i]!=NULL) {
			// hier fehlt PHP's htmlspecialchars:
			cout << "    " << envp[i] << "<br/>" << endl;
			i++;
		}
		cout << "  </p>" << endl;

		// Formulardaten anzeigen:
		cout << "  <h3>Formular-Echo</h3>" << endl;

		// Request-Methode des Formulars ermitteln:
		Environment ENV (envp);
		string RequestMethod = ENV.get("REQUEST_METHOD");
		cout << "  <p>Sie haben folgende Formulardaten mit der Methode " 
		     <<       RequestMethod << " &uuml;bermittelt.</p>" << endl;

		// Formulardaten abhängig von Request-Methode übernehmen
		cout << "  <p><strong>ParameterString:</strong><br/>" << endl; 
		string ParameterString;
		if (RequestMethod == "GET") {
			// GET: Formulardaten stehen in Umgebungvariable QUERY_STRING
			ParameterString = ENV.get("QUERY_STRING");
			cout << ParameterString << endl;
		}
		else if (RequestMethod == "POST") {
			// POST: Formulardaten kommen aus dem Eingabestrom
			cout << "<pre style=\"background-color:#EEEEEE\">" << endl;
			const int Laenge = 1000;
			char Puffer [Laenge];
			cin.getline (Puffer, Laenge);	// Achtung: setzt fail-Bit wenn Zeile länger als Puffer
			while (cin) {
				cout << Puffer << endl;
				cin.getline (Puffer, Laenge);
			}
			cout << "</pre>" << endl;
		}
		else
			// darf nicht auftreten
			throw "Ungültige REQUEST_METHOD: " + ENV.get("REQUEST_METHOD");
		cout << "  </p>" << endl;

		// Weitere Arbeiten zur Aufbereitung der Formulardaten:
		//   ParameterString zerlegen in einzelne Parameter
		//   Parameter zerlegen in Name und Wert
		//   Leerstellen restaurieren ('+' ersetzen durch ' ')
		//   Hex-Codes %xx umwandeln in Character
		//   für Echo: HTML-Sonderzeichen '&', '<', '>' kodieren als &..;
	}
	catch (string text) {
		// Fehlermeldung in HTML-Datei schreiben:
		cout << endl;
		cout << "<h3>FEHLER: " << text.c_str() << ".</h3>" << endl;
	}

	// Ende der HTML-Datei schreiben:
	cout << "</body>" << endl;
	cout << "</html>" << endl;
	return 0;
}
