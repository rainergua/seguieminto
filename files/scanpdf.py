import psycopg2
import shutil
from os import listdir
#Postgres
PSQL_HOST = "100.0.100.180"
PSQL_PORT = "5432"
PSQL_USER = "postgres"
PSQL_PASS = "cyt778@m1n$du"
PSQL_DB   = "fotoyat"
def carnet(ci):
	cedula = '\0'
	i=0
	fin = len(ci)
	for c in ci:
		if c != '0':
			cedula = ci[i:]
			print cedula
			break
		i = i + 1
		fin = len(ci)-i+1
	return cedula
try:
	ruta = './pdf/fail/fail'
	listado = listdir(ruta)
	connstr = "host=%s port=%s user=%s password=%s dbname=%s" % (PSQL_HOST, PSQL_PORT, PSQL_USER, PSQL_PASS, PSQL_DB)
	conn = psycopg2.connect(connstr)
	curpri = conn.cursor()
	for arch in listado:
		cirda = (arch.split(' '))
		ci = carnet(cirda[0])
		if (len(cirda) > 1):
			rda = cirda[1].split('.')
			if(len(rda) > 1 and len(ci) > 0):
				#print(rda[0])
				sql = """update "Maestro" set scandoc='1' where cod_rda ='%s' and carnet='%s'""" % (rda[0], ci)
				curpri.execute(sql)
				#print(sql, format(rda[0]))
				exito = curpri.rowcount
				if (exito != 1):
					print(ruta + "/fail" + "----" + ruta + "/" + arch)
					shutil.move(ruta + "/" + arch, ruta + "/fail")
				conn.commit()
			else:
				shutil.move(ruta + "/" + arch, ruta + "/fail")
		else:
			shutil.move(ruta + "/" + arch, ruta + "/fail")
		#Analizar cuando solo tiene un dato RDA o carnet
	#cur.close()
	curpri.close()
	conn.close()

	"""sqlqueryone = "select distinct carnet, rda from reporte"
	for rowone in curpri:
		cur = conn.cursor()
		sqlquery = "select rda, carnet, imagen from reporte where carnet='" + rowone[0] + "' and rda = '" + rowone[1] + "'"
		cur.execute(sqlquery)
		i = 0;
		for row in cur:
			#print(row[0] + "_" + row[1] + "_" + repr(i) + ".jpg")
			print '.',
			imgData = row[2]
			fh = open("/home/eduardo/python/src/fotos/" + row[0]+"_"+row[1] + "_" + repr(i) + ".jpg", "wb")
			try:
				imagen = imgData.decode('base64')
			except:
				imagen = ''
			fh.write(imagen)
			fh.close
			i+=1
		"""
except IOError:
	print("Error de e/s")
except ValueError:
	print("Error de valor num")
except ImportError:
	print("Modulo no encontrado")
