import serial
import requests
import time

jsonSend = []
carUid = "5911af30596e8";
userUid = "5911af30596e8";
ser = serial.Serial('/dev/ttyACM0',9600)
i = 0

while True:
	i +=1
	temp = ser.readline()
	jsonSend.append("{temp : " + temp.rstrip() + " }")

	time.sleep(1)

	if i == 5 :
		r = requests.post('http://raspincarapi.azurewebsites.net/car/' + carUid + '/' + userUid, data={'temps': jsonSend})
		jsonSend = []
		i = 0
