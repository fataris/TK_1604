# -*- coding: utf-8 -*-

from sonilab import sl_metro
from sonilab import sl_osc_send

import wakeupTimer as timer
import params

#METRO
metro1 = sl_metro.Metro(params.WAKE_METRO)
metro2 = sl_metro.Metro(params.DELAY_METRO)

if __name__ == "__main__":
  try:
    sender = sl_osc_send.slOscSend("224.0.0.1", 56789)

    while 1:
      timer.update()
      if metro1.update():
        if timer.isTime() > 0:
          print "wake up"
          sender.send("/wake", timer.getDelayTime())
      if metro2.update():
        timer.updateDelayTime()
  except KeyboardInterrupt:
    timer.close()
