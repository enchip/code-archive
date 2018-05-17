--
-- Tablo için tablo yapısı `IPDirectory`
--
CREATE TABLE `IPDirectory` (
  `ID` int(11) NOT NULL,
  `IP` varchar(64) NOT NULL,
  `STATUS` varchar(32) NOT NULL DEFAULT 'Allow',
  `DATETIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo için indeksler `IPDirectory`
--
ALTER TABLE `IPDirectory`
  ADD PRIMARY KEY (`ID`);
  
--
-- Tablo için AUTO_INCREMENT değeri `IPDirectory`
--
ALTER TABLE `IPDirectory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
