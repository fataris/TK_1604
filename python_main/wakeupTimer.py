# -*- coding: utf-8 -*-

import datetime
timeToWakeUp = datetime.datetime(2100, 1, 1, hour=0, minute=0, second=0, microsecond=0)

import oscReceiver as receiver
import getTrainInfo as info

import params

isSleeping = 1
delayTime = 0

def setTime(time):
  global delayTime
  print receiver.getUrl()
  delayTime = info.getInfo(str(receiver.getUrl()))
  print "delayTime : " + str(delayTime)

  
  global timeToWakeUp
  timeToWakeUp = time
  global isSleeping
  isSleeping = 1

  print "set ; " + str(timeToWakeUp - datetime.timedelta(minutes=delayTime*15 + params.USERMARGIN))


def isTime():
  global timeToWakeUp
  global isSleeping
  global delayTime

  timeToCheck = timeToWakeUp - datetime.timedelta(minutes=(delayTime * 15 + params.USERMARGIN))
#  if delayTime > 0:
 #   timeToCheck = timeTowakeUp - detetaime.timedelta(minutes=delayTime*15)
  #  print "[DELAYED!] Estimated alerm time : " + str(timeToCheck) 
  
  if timeToCheck < datetime.datetime.now():
    #print "time to wake up"
    if isSleeping == 1:
      isSleeping = 0
      return 1
    else:
      return 0
  else:
    return 0

def getDelayTime():
  global delayTime
  return delayTime+1
  
def updateDelayTime():
  global delayTime
  delayTime = info.getInfo(receiver.getUrl())
  if delayTime > 0:
    print "[DELAY]"

def update():
  global timeToWakeUp
  if timeToWakeUp != receiver.getTime():
    setTime(receiver.getTime())

def close():
  receiver.close()
