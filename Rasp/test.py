import serial
import requests
import uuid

carUid = "5911af30596e8";
userUid = "5911af30596e8";
ser = serial.Serial('/dev/ttyACM0',9600, timeout = 1)
statUid = uuid.uuid4();

while True:
	sensors = ser.readline()
	if sensors != "":
		print sensors
		# r = requests.post('http://raspincarapi.azurewebsites.net/car/' + carUid + '/' + userUid + '/' + statUid, data={'sensors': sensors})
