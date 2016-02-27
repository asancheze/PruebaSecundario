from socket import*
from datetime import*
import os

print("Bienvenido!")


ServerSock =  socket(AF_INET, SOCK_DGRAM) 
IPv4 = "192.168.0.6" 
Port = 8000
ServerSock.bind((IPv4,Port))
print("Conexión Configurada!")
while True: 
        try:
                print("A la espera de paquete...")
                data1, addr = ServerSock.recvfrom(1024)
                data=data1.decode("utf-8")
                print("Paquete recibido desde "+str(addr))
                print("Información Recibida: "+data)
                if data[0:4]==">RPV":
                        print("Coordenadas Recibidas!")
                        latInt = data[9:12]
                        longInt = data[17:21]
                        latDec = data[12:17]
                        longDec = data[21:26]
                        latitud = latInt + "." + latDec
                        longitud = longInt + "." + longDec
                        f= open('coordenadas.txt','a')
                        f.write(latitud+"\n")
                        f.write(longitud)
                        f.close()
                        print("Coordenadas Exportadas!")
                if data[0:4]==">REV":
                        print("Evento Recibido!")
                        timestamp = data[4:16]
                        weeks=timestamp[2:6]
                        weeksToSeconds = float(weeks)*7*24*60*60
                        days=timestamp[6]
                        daysToSeconds = float(days)*24*60*60
                        seconds = float(timestamp[7:12])
                        tgps = weeksToSeconds+daysToSeconds+seconds
                        gpsFromUTC = (datetime(1980,1,6)-datetime(1970,1,1)).total_seconds()
                        curDate = datetime.utcfromtimestamp(tgps+gpsFromUTC)
                        f=open('coordenadas.txt','w')
                        f.write(curDate.strftime("%Y-%m-%d %H:%M:%S")+"\n")
                        print("Fecha y Hora Exportadas!")
        except Exception:
                traceback.ex_print()
print("Proceso Terminado")

