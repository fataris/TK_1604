# -*- coding: utf-8 -*-

from sonilab import sl_metro
from sonilab import sl_osc_send

import wakeupTimer as timer
import params

#METRO
metro1 = sl_metro.Metro(params.WAKE_METRO)

#Time
import datetime
time = datetime.datetime(2100, 1, 1, hour = 0, minute = 0, second = 0, microsecond = 0)

if __name__ == "__main__":
  try:
    sender = sl_osc_send.slOscSend("224.0.0.1", 56789)

    while 1:
      timer.update()
      if metro1.update():
        if timer.isTime():
          #print "wake up"
          sender.send("/wake", timer.isTime())

  except KeyboardInterrupt:
    timer.close()
