# -*- coding: utf-8 -*-

import datetime
timeToWakeUp = datetime.datetime(2100, 1, 1, hour=0, minute=0, second=0, microsecond=0)

import oscReceiver as receiver


def setTime(time):
  global timeToWakeUp
  timeToWakeUp = time

  print "set to " + str(timeToWakeUp)


def isTime():
  global timeToWakeUp

  delayTime = receiver.getDelayStatus()
  timeToCheck = timeToWakeUp + datetime.timedelta(hours=delayTime)
  if delayTime > 0:
    print "[DELAYED!] Estimated alerm time : " +str(timeToCheck)

  if timeToCheck < datetime.datetime.now():
    return delayTime + 1
  else:
    return False


def update():
  global timeToWakeUp
  if timeToWakeUp != receiver.getTime():
    setTime(receiver.getTime())

def close():
  receiver.close()
