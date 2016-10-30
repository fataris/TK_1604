# -*- coding: utf-8 -*-


from sonilab import osc_receive
from sonilab import event


#Time
import datetime
time = datetime.datetime(2100, 1, 1, hour = 0, minute = 0, second = 0, microsecond = 0)

#OSC
receiver = osc_receive.OscReceive(54321)

#Time

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


def getTime():
  global time
  return time

#delay
delayTime = 0

def delay(vals):
  global delayTime
  delayTime = vals[0]
  print delayTime

event.add("/delay", delay)
receiver.setup("/delay")


def getDelayStatus():
  global delayTime
  return delayTime


#system
def close():
  receiver.terminate()
