--
-- Tablo için tablo yapısı `log`
--
CREATE TABLE `log` (
  `ID` int(11) NOT NULL,
  `IP` varchar(128) NOT NULL,
  `UID` varchar(32) NOT NULL DEFAULT '-',
  `DATE` datetime NOT NULL,
  `PAGE` varchar(255) NOT NULL,
  `CODE` varchar(32) NOT NULL,
  `RESULT` varchar(255) NOT NULL,
  `RESULT2` varchar(255) NOT NULL,
  `AGENT` varchar(255) NOT NULL,
  `REFERRER` varchar(255) NOT NULL,
  `EMAIL` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo için indeksler `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EMAIL` (`EMAIL`);
  
--
-- Tablo için AUTO_INCREMENT değeri `log`
--
ALTER TABLE `log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
