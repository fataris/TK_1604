# -*- coding: utf-8 -*-


from sonilab import osc_receive
from sonilab import event

#Time
import datetime
time = datetime.datetime(2100, 1, 1, hour = 0, minute = 0, second = 0, microsecond = 0)

#OSC
receiver = osc_receive.OscReceive(54321)

#Train info
url ="http://transit.yahoo.co.jp/search/result?flatlon=&from=中山&tlatlon=&to=品川&via=&via=&via=&y=2016&m=10&d=30&hh=14&m1=0&m2=0&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=品川"

def update(vals):
  global time
  #print vals
  year = vals[0]
  month = vals[1]
  date = vals[2]
  h = vals[3]
  m = vals[4]
  time = datetime.datetime(year, month, date, hour = h, minute = m)

event.add("/time", update)
receiver.setup("/time")

def stop():
  print "Wakes up"

event.add("/stop", stop)
receiver.setup("/stop")


def getTime():
  global time
  return time

#delay
delayTime = 0

def updateUrl(vals):
  global url
  url = vals[0]
  print url
event.add("/url", updateUrl)
receiver.setup("/url")

def getUrl():
  global url
  return url


#system
def close():
  receiver.terminate()
