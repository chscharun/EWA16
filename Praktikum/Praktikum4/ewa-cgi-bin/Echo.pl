#!C:\xampp\perl\bin\perl.exe -w

#!C:/apache/Perl/nsperl.exe -w
# Die 1. Zeile ist die Shebang-Zeile und enthält den Pfad zum Perl-Interpreter

##  echo.pl
##  Dieses Perl-Skript schickt Formulardaten an den Client zurück
##  Bernhard Kreling, 26.4.2011
##  Ralf Hahn, 17.04.2012 Anpassung auf HTML5 und Validator

# HTTP-Header für Antwort an Browser:
print "Content-type: text/html\n\n";

# HTML-Datei schreiben:
print '<!DOCTYPE html>', "\n";
print '<html lang="de">', "\n";
print "<head>\n";
print '  <meta charset="UTF-8" />', "\n";
print "  <title>CGI-Formular-Echo</title>\n";
print "</head>\n";
print "<body>\n";
print "  <h3>Formular-Echo</h3>\n";
print "  <p>Sie haben folgende Formulardaten mit der Methode ";

#  Formulardaten übernehmen abhängig von der Request-Methode:
my $ParameterString;
if ($ENV{'REQUEST_METHOD'} eq 'GET')
{
        print "GET";
        $ParameterString = $ENV{'QUERY_STRING'};
}
elsif($ENV{'REQUEST_METHOD'} eq 'POST')
{
        print "POST";
        read(STDIN, $ParameterString, $ENV{'CONTENT_LENGTH'});
        # auf mmlab erscheint die Meldung "HTTP/1.1 100 Continue" - warum auch immer...
}
print "  &uuml;bermittelt.</p>\n";

# Formulardaten als undekodierten String zurücksenden:
my $EscapedParameterString;
$EscapedParameterString = $ParameterString;
$EscapedParameterString =~ s/&/&amp;/g;

print "  <p><strong>ParameterString:</strong><br> $EscapedParameterString </p>\n";

# Formulardaten in einzelne Parameter zerlegen mit '&' als Trenner:
my @ParameterListe = split(/&/, $ParameterString);

print "  <p><strong>Einzelne Parameter:</strong><br>\n";
my $Parameter;
foreach $Parameter (@ParameterListe)
{
        # Parameter in Name und Wert zerlegen mit '=' als Trenner:
        my $Name;
        my $Wert;
        ($Name, $Wert) = split(/=/, $Parameter);

        # Leerstellen restaurieren ('+' ersetzen durch ' '):
        $Wert =~ tr/+/ /;

        # Hex-Codes %xx umwandeln in Character:
        $Wert =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C" , hex($1))/eg;

        # HTML-Sonderzeichen '&', '<', '>' kodieren:
        $Wert =~ s/&/&amp;/;
        $Wert =~ s/</&lt;/;
        $Wert =~ s/>/&gt;/;

        # Parameter ausgeben in HTML-Datei:
        print "$Name = $Wert <br>\n";
}

# HTML-Datei abschliessen:
print "  </p>\n";
print "</body>\n";
print "</html>\n";
