# Alftp
An FTP browser for Alfred 2.
![alftp-workflow](https://raw.github.com/janlay/alftp/master/screenshots/alftp-workflow.png)

## Features
- Support FTP/FTPS/SFTP
- browse full site in place
- Fast browsing by caching directory
- Copy path for file / directory (holding `⌘` key)
- Generates command for downloading (holding `⌥` key)
- Work together with [Douban Workflow](http://lucifr.com/2013/03/14/douban-workflow-for-alfred-v2/) (search movie)

## How it works
Alftp connects to the FTP server, retrieves files & directories list in current directory. New items are shown on top.
![alftp-list](https://raw.github.com/janlay/alftp/master/screenshots/alftp-list.png)

Icon of cached directory has an overlay.
![alft-cache](https://raw.github.com/janlay/alftp/master/screenshots/alftp-cache.png)

## How to install
1. Download the workflow from [Dropbox](https://www.dropbox.com/s/fqszv79hp1ei6mg/Alftp.alfredworkflow).
2. Just open the downloaded file, Alfred should open it. (Please make sure you have _Powerpack_ license installed.)
3. Double click the first item in right panel of the workflow, click 'Open workflow folder' button, then update settings in `config.php`.
4. Call Alfred with hotkey, type "`ftp`" (or other keyword you defined), Alftp works for you.

## Versions
- v0.1
  - Initial version.
- v0.2
  - Enable full site browsing.
  - Generate command for wget.
- v0.3
  - Search movie with Douban Workflow.

## Any plan?
- <strike>Cooperate with Douban Movie or IMDB</strike>
- Generate link for Xunlei

## Copyright & License
Copyright © 2013 Janlay Wu <janlay@gmail.com>.

Distributed under the MIT License.
