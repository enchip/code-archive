'VBScript ile çok sayıda dosyada Excel'i açmadan istenen verileri yazma işlemi

Set oFSO = CreateObject("Scripting.FileSystemObject")
Set oFolder = oFSO.GetFolder("D:\TEST\") 'dizin
Set oFiles = oFolder.Files 'dizin içerisindeki dosyalar
Dim excelUygulamasi
Dim excelCalismaKitabi
Dim SatirSayisi
Dim SatirSayisiTemp
For Each oFile In oFiles 'dizin içerisindeki her bir dosya için işlemleri yap
	Set excelUygulamasi = CreateObject("Excel.Application")
	excelUygulamasi.DisplayAlerts = False 'uyarıları kapat
	Set excelCalismaKitabi = excelUygulamasi.Workbooks.Open(oFile)
	excelUygulamasi.Visible = True 'excel açıldığında işlem bize görünsün
	Set objSheet = excelUygulamasi.ActiveWorkbook.Sheets("SAYFA_ADI")
	'On Error Resume Next
	SatirSayisi = objSheet.UsedRange.Rows.Count
	SatirSayisiTemp=1
	
		For i = 0 To SatirSayisi Step 1
			newNameTemp=Replace(oFile,oFolder,"") 'istenmeyen karakterleri ayıkla
			newName=Replace(newNameTemp,"\","") 'istenmeyen karakterleri ayıkla
			excelCalismaKitabi.Sheets("SAYFA_ADI").Range("N" & SatirSayisiTemp)=Replace(newName,".xlsx","")
			SatirSayisiTemp=SatirSayisiTemp+1
		Next
		
	excelCalismaKitabi.Save 'dosyayı kaydet
	excelUygulamasi.DisplayAlerts = True 'uyarıları eski haline getir
	excelCalismaKitabi.Close
	Set excelCalismaKitabi = Nothing
	Set excelUygulamasi = Nothing
Next
msgbox("Bitti")