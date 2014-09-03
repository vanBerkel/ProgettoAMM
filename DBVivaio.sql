-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generato il: 18 mar, 2012 at 11:22 PM
-- Versione MySQL: 5.1.54
-- Versione PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DBVivaio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE IF NOT EXISTS `attivita` (
  `Codice` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria',
  `Nome` varchar(200) NOT NULL,
  `CostoOrario` double(10,2) NOT NULL COMMENT 'Quanto costa questa attivita all''ora',
  `Piante` tinyint(1) DEFAULT NULL COMMENT 'se l''attivita utilizza pianta/e allora è a "true"',
  PRIMARY KEY (`Codice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`Codice`, `Nome`, `CostoOrario`, `Piante`) VALUES
(5, 'Potatura delle piante da frutta', 10.00, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita_cliente`
--

CREATE TABLE IF NOT EXISTS `attivita_cliente` (
  `IdAtt_Cliente` int(11) NOT NULL AUTO_INCREMENT,
  `IdAttivitaFK` int(11) DEFAULT NULL,
  `IdClienteFK` int(11) DEFAULT NULL,
  `DataPrenotazione` date DEFAULT NULL,
  `DataIntervento` date DEFAULT NULL,
  `IdPersonaleFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdAtt_Cliente`),
  KEY `IdAttivitaFK` (`IdAttivitaFK`),
  KEY `IdClienteFK` (`IdClienteFK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `attivita_cliente`
--

INSERT INTO `attivita_cliente` (`IdAtt_Cliente`, `IdAttivitaFK`, `IdClienteFK`, `DataPrenotazione`, `DataIntervento`, `IdPersonaleFK`) VALUES
(1, 5, 1, '2010-02-17', '2012-02-01', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL COMMENT 'il nome del privato o del pubblico',
  `Cognome` varchar(50) DEFAULT NULL COMMENT 'se si riferisce a una azienda allora rimane null',
  `Telefono` varchar(10) NOT NULL,
  `PrivatoPublico` varchar(8) NOT NULL COMMENT 'se si riferisce a un cliente di un''azienda o di un cliente',
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `Nome`, `Cognome`, `Telefono`, `PrivatoPublico`, `Username`, `Password`) VALUES
(1, '', NULL, '3465230701', '', 'Pier', 'annis');

-- --------------------------------------------------------

--
-- Struttura della tabella `personale`
--

CREATE TABLE IF NOT EXISTS `personale` (
  `IdPersonale` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) DEFAULT NULL,
  `Cognome` varchar(50) DEFAULT NULL,
  `Mansione` varchar(20) DEFAULT NULL,
  `AnnoAssunzione` int(11) DEFAULT NULL,
  `Specie` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`IdPersonale`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `personale`
--

INSERT INTO `personale` (`IdPersonale`, `Nome`, `Cognome`, `Mansione`, `AnnoAssunzione`, `Specie`) VALUES
(1, 'Pier', 'Annis', 'Agronomo', 2007, 1),
(2, 'Claudio', 'Fadda', 'Amministrativo', 2000, 0),
(5, 'Franco', 'Murtas', 'Agronomo', 2000, 1),
(6, 'Vasco', 'Brondi', 'Operaio', 2002, 0),
(8, 'Lucio', 'Tesla', 'Operaio', 2002, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `pianta`
--

CREATE TABLE IF NOT EXISTS `pianta` (
  `IdPianta` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `StagioneFioritura` varchar(20) NOT NULL,
  `Descrizione` text,
  `Disponibilita` int(11) NOT NULL,
  `IdSpecieFK` int(11) NOT NULL,
  `Immagine` varchar(200) NOT NULL COMMENT 'scrivere l''indirizzo dell''immagine',
  `Prezzo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IdPianta`),
  KEY `pianta_ibfk_1` (`IdSpecieFK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `pianta`
--

INSERT INTO `pianta` (`IdPianta`, `Nome`, `StagioneFioritura`, `Descrizione`, `Disponibilita`, `IdSpecieFK`, `Immagine`, `Prezzo`) VALUES
(2, 'Cocos nucifera', 'Primavera', 'La zona di origine della specie è controversa[2]. L''uomo ha sicuramente avuto una parte rilevante nella sua amplissima distribuzione. La pianta ha, tra le zone che vengono ritenute possibili per la sua origine, l''arcipelago indonesiano[2] e il sud america[2]. Nell''antichità la pianta era stata già diffusa in tutta l''area del Pacifico, con numerose varietà che si differenziano per il colore, la grandezza e la forma del frutto. Gli europei (portoghesi e spagnoli) scoprirono il cocco esplorando le coste occidentali dell''America centro-meridionale, e dal 1525 cominciarono a coltivarlo diffondendolo anche sulle coste orientali. Oggigiorno le principali zone di diffusione della palma da cocco sono situate tra il ventiduesimo parallelo nord e sud[2]. La palma è coltivabile oltre questi limiti di latitudine, ma le coltivazioni perdono importanza commerciale[2]. Generalmente le palme vengono coltivate sulla costa, ma la loro crescita non è limitata agli ambienti costieri. E'' possibile trovare palme anche a centinaia di chilometri lontano dalla costa quando le condizioni climatiche lo permettano[2]. In ogni caso l''influenza marina ha sicuramente un effetto positivo sul raccolto in frutti[2]. Generalmente la capacità delle noci di cocco di galleggiare sull''acqua marina è indicata come metodo di diffusione naturale della specie. Comunque, sebbene le noci di cocco siano in grado di mantenere la capacità di germogliare dopo 110 giorni di immersione nell''acqua di mare (periodo nel quale possono arrivare a percorrere fino a 5000 chilometri)[2] è stato fatto rilevare che dovunque è possibile trovare palme di cocco sulla linea di costa l''ambiente è sempre stato modificato dall''intervento umano.[2] Vi sono quindi seri dubbi che il galleggiamento rappresenti una delle modalità di diffusione tipiche della specie, specie su lunghe distanze, tranne in circostanze fortuite[2].', 25, 1, 'Cocos_nucifera.jpg', 50.00),
(3, 'FICUS ELASTICA (FICUS INDIANO)', 'Autunno', 'Il Ficus elastica è originario dell'' India ed è la specie ornamentale più conosciuta, soprattutto in Europa.\r\n\r\nCome pianta d''appartamento ha un modesto sviluppo, mentre nel suo habitat naturale può raggiungere dimensioni colossali.\r\n\r\nIl tronco produce numerose radici pensili , che dopo aver toccato il suolo si interrano e svolgono la funzione di fusti ausiliari. Le foglie sono grandi, ovate e terminano a punta e di consistenza coriacea provviste di un robusto picciolo; la lamina, di un bel verde scuro lucido, presenta le due metà disposte ad angolo rispetto alla nervatura centrale; il germoglio è di colore rosso o rosa e diventa verde man mano che si sviluppa.\r\n\r\nE'' una pianta che si presta bene ad essere allevata in appartamento, tollera gli ambienti secchi grazie alla spessa cuticola delle sue foglie e non ha particolari esigenze per cui può essere coltivata con successo anche dai neofiti.', 35, 5, 'ficus-elastica.jpg', 35.00),
(4, 'FICUS LIRATA (O PANDURATA)', 'Primavera', 'Il Ficus lirata è originaria dell'' Africa tropicale occidentale.E'' una splendida pianta caratterizzata da grandi foglie a forma di violino con la parte estrema della foglia molto più larga della parte basale lunghe fino a 60 cm e larghe 25 cm, di colore verde scuro lucido, coriacee,  con nervature e pieghe giallastra e con i bordi ondulati. Nei suoi luoghi d''origine il Ficus lyrata è un vero e proprio albero, molto imponente, mentre in vaso ha uno sviluppo piuttosto modesto (al massimo raggiunge un metro e mezzo d''altezza).Può essere allevata con successo in appartamento.', 48, 5, 'ficus-lirata_sm.jpg', 30.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `qualifica`
--

CREATE TABLE IF NOT EXISTS `qualifica` (
  `IdQualifica` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(200) NOT NULL,
  PRIMARY KEY (`IdQualifica`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `qualifica`
--

INSERT INTO `qualifica` (`IdQualifica`, `Nome`) VALUES
(1, 'Tutto Fare'),
(2, 'Gestione Fiori'),
(3, 'Potatore'),
(4, 'giardiniere');

-- --------------------------------------------------------

--
-- Struttura della tabella `qualifica_attivita`
--

CREATE TABLE IF NOT EXISTS `qualifica_attivita` (
  `Cod` int(11) NOT NULL AUTO_INCREMENT,
  `IdAttivitaFK` int(11) DEFAULT NULL,
  `IdQualificaFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`Cod`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `qualifica_attivita`
--

INSERT INTO `qualifica_attivita` (`Cod`, `IdAttivitaFK`, `IdQualificaFK`) VALUES
(1, 5, 1),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `qualifica_personale`
--

CREATE TABLE IF NOT EXISTS `qualifica_personale` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IdPersonaleFK` int(11) DEFAULT NULL,
  `IdQualificaFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IdQualificaFK` (`IdQualificaFK`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `qualifica_personale`
--

INSERT INTO `qualifica_personale` (`ID`, `IdPersonaleFK`, `IdQualificaFK`) VALUES
(2, 5, 2),
(3, 6, 1),
(5, 8, 1),
(6, 8, 2),
(7, 8, 3),
(8, 8, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `specie`
--

CREATE TABLE IF NOT EXISTS `specie` (
  `IdSpecie` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) DEFAULT NULL COMMENT 'inizio parte riservata alla specie',
  `Descrizione` longtext,
  `InfoMetodoColt` text COMMENT 'Informazioni sul metodo di coltivazione',
  `CarEsposizione` text COMMENT 'informazioni sulle caratteristiche d''esposizione',
  `InternoEsterno` varchar(7) DEFAULT NULL COMMENT 'Se è una specie utilizzata per interno o per esterno',
  `Immagine` varchar(200) DEFAULT NULL COMMENT 'Scrivere l''indirizzo dell''immagine',
  `IdPersonaleFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdSpecie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `specie`
--

INSERT INTO `specie` (`IdSpecie`, `Nome`, `Descrizione`, `InfoMetodoColt`, `CarEsposizione`, `InternoEsterno`, `Immagine`, `IdPersonaleFK`) VALUES
(1, 'Palma', 'Arecaceae (Palmae)\r\n\r\nLa famiglia delle Arecaceae è un grande gruppo che riunisce circa 2500 specie arboree distribuite nelle regioni equatoriali, tropicali e subtropicali del globo, dove costituiscono un elemento molto caratteristico del paesaggio. Le principali aree geografiche che hanno avuto il ruolo di centri di differenziazione sono le coste equatoriali dell''Africa, la regione Indomalese, le Isole della Sonda, l''Oceania, la costa del Brasile, l''Amazzonia e le Antille. È nel Cretaceo che questo gruppo ha avuto la sua massima diffusione e differenziazione, lasciando numerosi resti fossili di tronchi e foglie.\r\n\r\nL''habitus delle palme è molto tipico, in quanto esse sono caratterizzate da un lungo fusto (fino a 80 metri in Cocos), non ramificato o, raramente, dicotomo (Hyphaene), e di diametro costante dal basso verso l''alto, che all''apice porta una rosetta di grandi foglie coriacee, palmate o pennate, lunghe fino a qualche metro. Il fusto si può mantenere anche molto sottile e in tal caso diviene strisciante (Calamus), o può essere brevissimo nelle specie acauli (Phoenix acaulis). Un''altra peculiare caratteristica della famiglia risiede nel fatto che il fusto raggiunge il suo diametro definitivo prima che inizi il suo accrescimento in altezza; le palme, infatti, mancano di un accrescimento secondario.\r\n\r\nLe infiorescenze sono a spadice, circondate inizialmente da una spata o da guaine fogliari che si aprono durante l''antesi. I fiori sono solitamente unisessuali e derivano da fiori ermafroditi per aborto; nelle specie monoiche i fiori maschili sono all''apice dell''infiorescenza e quelli femminili alla base; la proterandria garantisce la fecondazione incrociata. I fiori sono per lo più pentaciclici trimeri. Il perigonio è formato da 2 verticilli di 3 tepali generalmente membranosi; l''androceo, nei fiori maschili, consta di 2 verticilli di 3 stami, schema dal quale, però, si distaccano alcuni taxa, con 3-9-molti stami; i fiori femminili possiedono un ovario supero 3-1 loculare, formato da 3 carpelli liberi o saldati, ciascuno con un solo ovulo. La formula più rappresentativa della struttura fiorale della famiglia è la seguente:\r\n\r\nP 3+3, A 3+3 G 3\r\n\r\nIl frutto può essere una bacca (Phoenix) o una drupa (Cocos). Solitamente una sola loggia fecondata continua lo sviluppo, mentre le altre regrediscono, cosicché il frutto contiene un solo seme. L''impollinazione è prevalentemente anemogama e, allo scopo, la pianta produce una grande quantità di polline. Vi sono anche alcune specie entomogame, nelle quali la spata può emanare profumo per attirare i pronubi. Si distinguono specie monocarpiche, con le infiorescenze sull''asse in posizione terminale, che vivono un certo numero di anni senza riprodursi e che muoiono subito dopo la fioritura (Corypha) e specie policarpiche, con infiorescenze ascellari e capaci di fiorire molte volte.\r\n\r\nLa famiglia è tradizionalmente suddivisa in varie sottofamiglie: a) Phytelephasieae, con fiori senza perianzio, numero elevato di stami nei fiori maschili e fiori femminili con ovario multiloculare (4-9 logge), infruttescenze (Phytelephas); b) Coryphoideae, con caratteri fiorali tipici della famiglia, carpelli liberi, frutto a bacca, foglie pennate o a ventaglio (Phoenix, Chamaerops, Trachycarpus, Livistona, Sabal, Washingtonia; c) Borassoideae, con foglie a ventaglio, perianzio tipico della famiglia, ovario sincarpico (Hyphaene, Borassus, Lodoicea); d) Lepidocaryoideae, con ovario sincarpico e frutti coperti di scaglie embriciate (Raphia, Metroxylon, Calamus); e) Ceroxyloideae, con ovario sincarpico e foglie pennate (Arenga, Ceroxylon, Areca, Cocos); f) Nipoideae, fiori maschili con 3 stami connati, ovario uniloculare (Nipa).\r\n\r\nLe Arecaceae comprendono piante molto importanti per l''economia umana. In particolare, dalla palma da cocco, Cocos nucifera, diffusa lungo le coste marine equatoriali del Vecchio Mondo, si ricavano una moltitudine di sostanze alimentari; infatti, dalla drupa, detta noce di cocco, con la cavità dell''endocarpo occupata da un enorme albume e da un liquido detto latte, si ricavano grassi, olio, vino, latte di cocco. Le gemme, inoltre vengono utilizzate come verdura, e il tronco viene adoperato come legname. Grande importanza ha anche Phoenix dactylifera, la palma da dattero, soprattutto nell''economia dei paesi maghrebini, che produce grandi quantità di frutti (bacche). Molte specie vengono, poi, impiegate per la produzione di fibre vegetali (Sabal, Chamaerops, Trachycarpus, Borassus, ecc.), altre, con endosperma corneo, per la produzione del cosiddetto avorio vegetale (Phytelephas macrocarpa). Moltissime palme vengono anche impiegate, nelle nostre regioni a clima più mite, per la realizzazione di alberature in parchi, giardini, piazze e viali. Tra le più utilizzate a questo scopo si ricordano Phoenix canariensis, P. dactylifera, Washingtonia filifera, W. robusta, Syagrus romanzoffiana, Trachycarpus fortunei, ecc.\r\n\r\nAllo stato spontaneo in Italia è presente unicamente Chamaerops humilis, specie di non grandi dimensioni, frequente lungo le coste del Meridione e delle Isole maggiori, dove si insedia in aree costiere, partecipando alla costituzione di aspetti di macchia termo-xerofila dell''Oleo-Ceratonion. ', NULL, NULL, 'Interno', 'palme.jpg', 1),
(5, 'Ficus', 'La parola Ficus in latino significa "fico" che comprende però oltre alla famosa ed apprezzata pianta da frutto anche una serie incredibile di piante ornamentali, molto diffuse ed apprezzate per la bellezza del loro fogliame che le rende particolarmente decorative. ', NULL, NULL, 'Interno', 'benjamin.jpg', NULL);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `pianta`
--
ALTER TABLE `pianta`
  ADD CONSTRAINT `pianta_ibfk_1` FOREIGN KEY (`IdSpecieFK`) REFERENCES `specie` (`IdSpecie`);
