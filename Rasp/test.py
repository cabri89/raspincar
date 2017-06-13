import serial
import requests
import uuid

carUid = "594057f143e77";
userUid = "5911af30596e8";
ser = serial.Serial('/dev/ttyACM0',9600, timeout = 1)
statUid = uuid.uuid4();

while True:
	print "Loading"
	sensors = ser.readline()
	if sensors != "":
		print "send"
		print sensors
		# r = requests.post('http://raspincarapi.azurewebsites.net/addstatcar/' + carUid + '/' + userUid + '/' + statUid, data={'sensors': sensors})
		r = requests.post('http://192.168.43.32:8000/addstatcar/' + carUid + '/' + userUid + '/' + str(statUid), data={'sensors': sensors})
