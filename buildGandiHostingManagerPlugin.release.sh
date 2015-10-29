#!/bin/sh

cd ..
rm GandiHostingManager.zip
zip -r GandiHostingManager.zip GandiHostingManager -x *.git*
cd GandiHostingManager
