import serial
import requests
import time

jsonSend = []

ser = serial.Serial('/dev/ttyACM0',9600)
i = 0

while True:
	i +=1
	temp = ser.readline()
	jsonSend.append("{temp : " + temp.rstrip() + " }")

	time.sleep(1)

	if i == 5 :
		response = jsonSend
		r = requests.post('https://lepetitdev.herokuapp.com/api', data={'uuid' : '5911af30596e8', 'temps': response})
		i = 0
