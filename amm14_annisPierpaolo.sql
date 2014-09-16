-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Set 16, 2014 alle 07:33
-- Versione del server: 5.5.35-0ubuntu0.13.10.2
-- Versione PHP: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amm14_annisPierpaolo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisto`
--

CREATE TABLE IF NOT EXISTS `acquisto` (
  `cliente_fk` int(11) NOT NULL,
  `pianta_fk` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  KEY `cliente_fk` (`cliente_fk`),
  KEY `pianta_fk` (`pianta_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `acquisto`
--

INSERT INTO `acquisto` (`cliente_fk`, `pianta_fk`, `quantita`) VALUES
(1, 3, 2),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `giorno`
--

CREATE TABLE IF NOT EXISTS `giorno` (
  `day` date NOT NULL,
  `giardiniere_fk` int(11) NOT NULL,
  `cliente_fk` int(11) NOT NULL,
  KEY `giardiniere_fk` (`giardiniere_fk`),
  KEY `cliente_fk` (`cliente_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `giorno`
--

INSERT INTO `giorno` (`day`, `giardiniere_fk`, `cliente_fk`) VALUES
('2014-09-14', 2, 1),
('2014-09-15', 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `personale`
--

CREATE TABLE IF NOT EXISTS `personale` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` char(50) NOT NULL,
  `Password` char(50) NOT NULL,
  `Nome` char(50) NOT NULL,
  `Cognome` char(50) NOT NULL,
  `Citta` char(50) NOT NULL,
  `Indirizzo` char(50) NOT NULL,
  `Cap` int(5) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Email` char(50) NOT NULL,
  `Mansione` char(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `personale`
--

INSERT INTO `personale` (`Id`, `Username`, `Password`, `Nome`, `Cognome`, `Citta`, `Indirizzo`, `Cap`, `Telefono`, `Email`, `Mansione`) VALUES
(1, 'admin', 'admin', 'Pier Paolo', 'Annis', 'Pimentel', 'via Verdi 10', 9020, 346523010, 'annispmt92@hotmail.it', 'admin'),
(2, 'SempreVerde', 'SempreVerde', 'Alfonso', 'Correntini', 'Cagliari', 'via Oristano, 14', 9121, 345212456, 'correntini@vivaio.it', 'giardiniere'),
(5, 'cliente', 'cliente', 'Cliente', 'Cliente', 'Cliente', 'cliente', 987, 8789787, 'cliente@cliente.it', 'cliente'),
(6, 'maria', 'giovanna', 'maria giovanna', 'annis', '', 'via verdi', 0, 333333333, 'lllj@hot.it', 'cliente'),
(7, 'carlo', 'carlo', 'carlo', 'massida', 'messico', 'via verdi', 5123, 546631313, 'kjkjk@', 'amministratore'),
(8, 'vale', 'vale', 'vale', 'fufi', 'cagli', 'valerio', 0, 7, '', 'cliente');

-- --------------------------------------------------------

--
-- Struttura della tabella `pianta`
--

CREATE TABLE IF NOT EXISTS `pianta` (
  `IdPianta` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) NOT NULL,
  `Descrizione` text,
  `Disponibilita` int(11) NOT NULL,
  `IdSpecieFK` int(11) NOT NULL,
  `Immagine` varchar(200) NOT NULL COMMENT 'scrivere l''indirizzo dell''immagine',
  `Prezzo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`IdPianta`),
  KEY `pianta_ibfk_1` (`IdSpecieFK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dump dei dati per la tabella `pianta`
--

INSERT INTO `pianta` (`IdPianta`, `Nome`, `Descrizione`, `Disponibilita`, `IdSpecieFK`, `Immagine`, `Prezzo`) VALUES
(2, 'Cocos nucifera', 'La zona di origine della specie è controversa[2]. L''uomo ha sicuramente avuto una parte rilevante nella sua amplissima distribuzione. La pianta ha, tra le zone che vengono ritenute possibili per la sua origine, l''arcipelago indonesiano[2] e il sud america[2]. Nell''antichità la pianta era stata già diffusa in tutta l''area del Pacifico, con numerose varietà che si differenziano per il colore, la grandezza e la forma del frutto. Gli europei (portoghesi e spagnoli) scoprirono il cocco esplorando le coste occidentali dell''America centro-meridionale, e dal 1525 cominciarono a coltivarlo diffondendolo anche sulle coste orientali. Oggigiorno le principali zone di diffusione della palma da cocco sono situate tra il ventiduesimo parallelo nord e sud[2]. La palma è coltivabile oltre questi limiti di latitudine, ma le coltivazioni perdono importanza commerciale[2]. Generalmente le palme vengono coltivate sulla costa, ma la loro crescita non è limitata agli ambienti costieri. E'' possibile trovare palme anche a centinaia di chilometri lontano dalla costa quando le condizioni climatiche lo permettano[2]. In ogni caso l''influenza marina ha sicuramente un effetto positivo sul raccolto in frutti[2]. Generalmente la capacità delle noci di cocco di galleggiare sull''acqua marina è indicata come metodo di diffusione naturale della specie. Comunque, sebbene le noci di cocco siano in grado di mantenere la capacità di germogliare dopo 110 giorni di immersione nell''acqua di mare (periodo nel quale possono arrivare a percorrere fino a 5000 chilometri)[2] è stato fatto rilevare che dovunque è possibile trovare palme di cocco sulla linea di costa l''ambiente è sempre stato modificato dall''intervento umano.[2] Vi sono quindi seri dubbi che il galleggiamento rappresenti una delle modalità di diffusione tipiche della specie, specie su lunghe distanze, tranne in circostanze fortuite[2].', 33, 1, 'Cocos_nucifera.jpg', 50.00),
(3, 'Ficus indiano', 'Il Ficus elastica è originario dell'' India ed è la specie ornamentale più conosciuta, soprattutto in Europa.\r\n\r\nCome pianta d''appartamento ha un modesto sviluppo, mentre nel suo habitat naturale può raggiungere dimensioni colossali.\r\n\r\nIl tronco produce numerose radici pensili , che dopo aver toccato il suolo si interrano e svolgono la funzione di fusti ausiliari. Le foglie sono grandi, ovate e terminano a punta e di consistenza coriacea provviste di un robusto picciolo; la lamina, di un bel verde scuro lucido, presenta le due metà disposte ad angolo rispetto alla nervatura centrale; il germoglio è di colore rosso o rosa e diventa verde man mano che si sviluppa.\r\n\r\nE'' una pianta che si presta bene ad essere allevata in appartamento, tollera gli ambienti secchi grazie alla spessa cuticola delle sue foglie e non ha particolari esigenze per cui può essere coltivata con successo anche dai neofiti.', 32, 5, 'ficus-elastica.jpg', 35.00),
(4, 'Ficus lirata', 'Il Ficus lirata è originaria dell'' Africa tropicale occidentale.E'' una splendida pianta caratterizzata da grandi foglie a forma di violino con la parte estrema della foglia molto più larga della parte basale lunghe fino a 60 cm e larghe 25 cm, di colore verde scuro lucido, coriacee,  con nervature e pieghe giallastra e con i bordi ondulati. Nei suoi luoghi d''origine il Ficus lyrata è un vero e proprio albero, molto imponente, mentre in vaso ha uno sviluppo piuttosto modesto (al massimo raggiunge un metro e mezzo d''altezza).Può essere allevata con successo in appartamento.', 48, 5, 'ficus-lirata_sm.jpg', 30.00),
(10, 'Iris vulgaris', 'bellissimo tubero che sboccia in marzo. I suoi fiori viola o bianchi danno un tocco moderno ai giardini con una linea severa. Il sacco contiene 7 tuberi.', 30, 9, 'iris.jpg', 2.00),
(11, 'Palma Florentis', 'La palma florentis..........', 24, 1, 'palmaflorentis.jpg', 62.00),
(12, 'Palma Longa', 'Palma originaria delle oasi del Sahara del nord, si Ã¨ ambientata molto bene negli spazi di tutta la costa del Mediterraneo.', 40, 1, 'palmalonga.jpg', 86.79),
(13, 'Palma Invasus', 'Questo tipo di palma, grazie alle sue dimensioni ridotte si presta molto alla coltura in vasi.', 63, 1, 'palmainvasus.jpg', 68.00),
(15, 'Crisantemo palla di neve', 'Questo tipo di crisantemo si apre completamente formando una palla soffice e leggera. Proprio per la sua forma particolare il nome di palla di neve.\r\n', 150, 6, 'crisantemopalladineve.jpg', 2.00),
(16, 'Crisantemo Maggie', 'Il crisantemo Maggie, come molti crisantemi, ha i petali lunghi e fini il colore varia a seconda del tipo. ', 210, 6, 'crisantemomaggie.jpg', 1.50),
(17, 'Naricisium Tondeggiantis', 'Diversamente da altri narcisi questo genere ha la parte centrale molto piÃ¹ grande rispetto alle altre parti della pianta. Inoltre tutta la pianta Ã¨ molto piÃ¹ "rotondeggiante" rispetto ad altri esemplari della sua stessa famiglia.\r\nnel sacchetto si trovano 6 bulbi', 96, 9, 'narcisiumtondeggiantis.jpg', 3.50),
(18, 'Lady Madelaine', 'Piccoli fiori viola su un piccolo fusto castano. Lady madelaine colora i giardini rocciosi da settembre.', 85, 12, 'ladymadelaine.jpg', 1.50),
(19, 'Papavero domestico', 'siamo abituati a vedere chiazze rosse  tra i campi delle nostre campagne, il seme che vi proponiamo Ã¨ un cugino del papavero comune. Esso Ã¨ piÃ¹ grande e di un rosso piÃ¹ intenso. Si adatta facilmente alla coabitazione con altre specie floreali. ', 65, 12, 'papavero.jpg', 1.60),
(20, 'Caragansum', 'Della famiglia delle margherite, il caragansum Ã¨ la piÃ¹ alta e grande della sua specie. I suoi petali gialli illuminano gli spazi piÃ¹ ombrosi. Cresce durante i mesi invernali per poi sbocciare nella prima primavera.', 319, 7, 'caragansum.jpg', 1.30),
(21, 'Margherita lungas', 'Originaria della Spagna interna, questo tipo ha i petali molto fini e il suo interno di un colore piÃ¹ intenso la fa riassomigliare questo esemplare a cuore nero. Fiorisce in tarda primavera, predilige luoghi poco soleggiati e terreni smepre umidi, attenzione a non esagerare le innaffiature.', 74, 7, 'margheritalungas.jpg', 3.20),
(22, 'Falsa Camomilla', 'Molto simile alla Camomilla, la falsa cresce piÃ¹ facilmente in terreni anche molto soleggiati se curate con abbondante acqua anche nella stagione estiva continua a fiorire anche nei mesi piÃ¹ caldi.', 88, 7, 'falsacamomilla.jpg', 2.10),
(23, 'Cuore Nero', 'Originaria della Gran Bretagna, Cuore nero Ã¨ una particolare margherita con la parte centrale di un colore scurissimo quasi nero. CiÃ² Ã¨ dovuto alla basicitÃ  del terreno infatti piÃ¹ il terreno Ã¨ acido piÃ¹ questa parte Ã¨ scura e i petali piÃ¹ chiari.\r\nPer questa margherita consigliamo le piantine che sopportano meglio il  trapianto.', 110, 7, 'margheritacuorenero.jpg', 4.10),
(24, 'Buongiorno', 'Deve il suo nome al momento in cui apre e chiude i suoi petali, cioÃ¨ prime del sorgere del sole e si chiudono dopo qualche ora che Ã¨ sorto. Cugina di questa graziosa margherita Ã¨ la Buonanotte.', 60, 7, 'margheritabuongiorno.jpg', 2.00),
(25, 'Porcospinus Florealis', 'Pianta di origine asiatica, si adatta bene negli ampi spazi. Il suo tronco Ã¨ forgiato di piccole spine. I suoi fiori enormi sbocciano verso settembre colorando con il suo ampio ombrello gran parte dello spazio.\r\n', 31, 20, 'porcospinusflorealis.jpg', 305.00),
(26, 'Girasole Gigante', 'Splendida pianta ornamentale.\r\nOltre a colorare il giardino o I nostri orti il girasole Ã¨ utilizzato per I suoi semi con cui si produce lâ€™olio. Dei semi sono molto ghiotti alcuni tipi di uccelli e altri animali. \r\nCure: il seme viene messo in terra in primavera cosÃ¬ che la pianta abbia il tempo di crescere tanto da diventare gigante. \r\n', 64, 19, 'girasolegigante.jpg', 2.20),
(27, 'Oleandro Blanco', 'Non Ã¨ raro vedere bellissimi cespugli o siepi di oleandro. Questa specie ama il caldo, non sopporta le abbondanti innaffiature e teme il geloua.\r\nLâ€™oleandro non ha bisogno di molte cure, ma occhio quando arriva lâ€™inverno.\r\nPotandolo nella giusta maniera si possono avere delle bellissime siepi sempre verdi con fiori bianchi in primavera inizio estate.', 36, 22, 'oleandro.jpg', 20.00),
(28, 'Aloe americana', 'Bellissima aloe con le foglie gialle verdi. Ama i terreni rocciosi e difficili. Le sue dimensioni enormi richiedono una particolare attenzione in quanto potrebbe diventare un problema per altre piante.', 52, 21, 'aloe.jpg', 18.00),
(29, 'Sistis', 'La Sistis Ã¨ una pianta che neccessitÃ  continui rinvasi invernali in quanto teme la troppa umiditÃ .', 79, 21, 'sistis.jpg', 10.00),
(30, 'Libertum', 'Questa piccola piantina non ha bisogno di terra ma solo di umiditÃ . Le sue radici interne sono un tuttuno con il fusto. Prediligono luoghi non troppo esposti ai raggi solari, allo stesso tempo caldi e umidi. ', 100, 21, 'libertum.jpg', 5.10),
(31, 'Cotonati', 'Questa pianta fa parte della famiglia delle cannutte. Il suo habitat naturale  sono bordi di fiumi, stagni e laghi. Originaria delle oasi del Sahara ama il caldo e abbondanti ma non frequenti innaffiature.', 46, 22, 'cotonati.jpg', 18.00),
(32, 'Pino Alpino', 'tipico delle alpi il pino alpino predilige i terreni montuosi inverni freddi e secchi, tee il caldo e lunghi periodi di siccitÃ .', 0, 28, 'pinoalpino', 0.00),
(33, 'Pino Marittimo', 'Il pino marittimo Ã¨ tipico delle zone costiere. Perfetto per le caldi estate quando si cerca un po di fresco sotto un albero', 34, 28, 'pinomarittimo', 150.00),
(34, 'Cipresso', 'Elegante si inalza verso il cielo il suo fogliame verde scuro spicca tra i verdi chiari dando un bel contrasto tra il verde avvolte troppo e solo verde chiaro.', 50, 28, 'conifera.jpg', 130.00),
(35, 'Verdicum medusa', 'Questa rampicante predilige terreni ombreggiati e estati non troppo calde. I suoi fiori gialli sbocciano in Aprile. Finiscono ad aprirsi diventando simili a meduse questa parte si stacca dalla pianta e vola via portando con se i semi.', 42, 29, 'verdicummedusa.jpg', 25.00),
(36, 'Buganville', 'Bellissima pianta ', 0, 29, 'buganville.jpg', 0.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `specie`
--

CREATE TABLE IF NOT EXISTS `specie` (
  `IdSpecie` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(50) DEFAULT NULL COMMENT 'inizio parte riservata alla specie',
  `Descrizione` longtext,
  PRIMARY KEY (`IdSpecie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dump dei dati per la tabella `specie`
--

INSERT INTO `specie` (`IdSpecie`, `Nome`, `Descrizione`) VALUES
(1, 'Palma', ''),
(5, 'Ficus', ''),
(6, 'Crisantemi', ''),
(7, 'Margherite', 'gi'),
(9, 'Tuberi e Bulbose', ''),
(12, 'Fiori perenni', ''),
(16, 'Caragansum', 'Della famiglia delle margherite, il caragansum Ã¨ la piÃ¹ alta e grande della sua specie. I suoi petali gialli illuminano gli spazi piÃ¹ ombrosi. Cresce durante i mesi invernali per poi sbocciare nella prima primavera.'),
(17, 'Margherita lungas', 'Originaria della Spagna interna, questo tipo ha i petali molto fini e il suo interno di un colore piÃ¹ intenso la fa riassomigliare questo esemplare a cuore nero. Fiorisce in tarda primavera, predilige luoghi poco soleggiati e terreni smepre umidi, attenzione a non esagerare le innaffiature.'),
(18, 'Falsa Camomilla', 'Molto simile alla Camomilla, la falsa cresce piÃ¹ facilmente in terreni anche molto soleggiati se curate con abbondante acqua anche nella stagione estiva continua a fiorire anche nei mesi piÃ¹ caldi.'),
(19, 'Cuore Nero', 'Originaria della Gran Bretagna, Cuore nero Ã¨ una particolare margherita con la parte centrale di un colore scurissimo quasi nero. CiÃ² Ã¨ dovuto alla basicitÃ  del terreno infatti piÃ¹ il terreno Ã¨ acido piÃ¹ questa parte Ã¨ scura e i petali piÃ¹ chiari.\r\nPer questa margherita consigliamo le piantine che sopportano meglio il  trapianto.'),
(20, 'Grandi alberi', 'Deve il suo nome al momento in cui apre e chiude i suoi petali, cioÃ¨ prime del sorgere del sole e si chiudono dopo qualche ora che Ã¨ sorto. Cugina di questa graziosa margherita Ã¨ la Buonanotte.'),
(21, 'Succulente ', 'Piante capaci di resistere i periodi di siccità anche molto lunghi. Esistono tantissime famiglie di questa specie tutte amano il caldo.\r\n'),
(22, 'Arbusti e cespugli', 'Per una siepe, per un piccolo angolo selvaggio nel vostro giardino, o semplicemente per ombreggiare. Molti arbusti in base alla loro potatura possono prendere diverse forme per rendere particolare i giardini.\r\n'),
(23, 'Oleandro Blanco', 'Non Ã¨ raro vedere bellissimi cespugli o siepi di oleandro. Questa specie ama il caldo, non sopporta le abbondanti innaffiature e teme il geloua.\r\nLâ€™oleandro non ha bisogno di molte cure, ma occhio quando arriva lâ€™inverno.\r\nPotandolo nella giusta maniera si possono avere delle bellissime siepi sempre verdi con fiori bianchi in primavera inizio estate.'),
(24, 'Aloe americana', 'Bellissima aloe con le foglie gialle verdi. Ama i terreni rocciosi e difficili. Le sue dimensioni enormi richiedono una particolare attenzione in quanto potrebbe diventare un problema per altre piante.'),
(25, 'Sistis', 'La Sistis Ã¨ una pianta che neccessitÃ  continui rinvasi invernali in quanto teme la troppa umiditÃ .'),
(26, 'Libertum', 'Questa piccola piantina non ha bisogno di terra ma solo di umiditÃ . Le sue radici interne sono un tuttuno con il fusto. Prediligono luoghi non troppo esposti ai raggi solari, allo stesso tempo caldi e umidi. '),
(27, 'Cotonati', 'Questa pianta fa parte della famiglia delle cannutte. Il suo habitat naturale  sono bordi di fiumi, stagni e laghi. Originaria delle oasi del Sahara ama il caldo e abbondanti ma non frequenti innaffiature.'),
(28, 'Conifere', ''),
(29, 'Rampicanti', '');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `acquisto`
--
ALTER TABLE `acquisto`
  ADD CONSTRAINT `acquisto_ibfk_1` FOREIGN KEY (`cliente_fk`) REFERENCES `personale` (`Id`),
  ADD CONSTRAINT `acquisto_ibfk_2` FOREIGN KEY (`pianta_fk`) REFERENCES `pianta` (`IdPianta`),
  ADD CONSTRAINT `acquisto_ibfk_3` FOREIGN KEY (`pianta_fk`) REFERENCES `pianta` (`IdPianta`);

--
-- Limiti per la tabella `giorno`
--
ALTER TABLE `giorno`
  ADD CONSTRAINT `giorno_ibfk_1` FOREIGN KEY (`giardiniere_fk`) REFERENCES `personale` (`Id`),
  ADD CONSTRAINT `giorno_ibfk_2` FOREIGN KEY (`cliente_fk`) REFERENCES `personale` (`Id`);

--
-- Limiti per la tabella `pianta`
--
ALTER TABLE `pianta`
  ADD CONSTRAINT `pianta_ibfk_1` FOREIGN KEY (`IdSpecieFK`) REFERENCES `specie` (`IdSpecie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
