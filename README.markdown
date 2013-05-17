# Alftp
An FTP browser for Alfred 2.
![alftp-workflow](https://raw.github.com/janlay/alftp/master/screenshots/alftp-workflow.png)

## Features
- Support FTP/FTPS/SFTP
- browse full site in place
- Fast browsing by caching directory
- Copy path for file / directory (holding <kbd>⌘</kbd> key)
- Generates command for downloading (holding <kbd>⌥</kbd> key)
- Work together with [Douban Workflow](http://lucifr.com/2013/03/14/douban-workflow-for-alfred-v2/) (holding <kbd>⌃</kbd> key to search movies)

## How it works
Alftp connects to the FTP server, retrieves files & directories list in current directory. New items are shown on top.
![alftp-list](https://raw.github.com/janlay/alftp/master/screenshots/alftp-list.png)

Icon of cached directory has an overlay.
![alft-cache](https://raw.github.com/janlay/alftp/master/screenshots/alftp-cache.png)

## Download
\* You may want to install Alftp from Alfred itself. if [Hatmaker](https://github.com/bpinto/hatmaker) has been installed, Just type `install Alftp` in Alfred's popup window. Type `outdated` to update Alftp to the latest version.
 -- or --
Download the workflow from [Dropbox](https://www.dropbox.com/s/fqszv79hp1ei6mg/Alftp.alfredworkflow).

## Install & configure
1. Just open the downloaded file, Alfred should open it. (Please make sure you have _Powerpack_ license installed.)
2. Double click the first item in right panel of the workflow, click 'Open workflow folder' button, then update settings in `config.php`.
3. Call Alfred with hotkey, type "`ftp`" (or other keyword you defined), Alftp works for you.

## Versions
- v0.1
  - Initial version.
- v0.2
  - Enable full site browsing.
  - Generate command for wget.
- v0.3
  - Search movies with Douban Workflow.
  - Append release year to search keywords. (v0.3.1)
  - Recognize movie title and release year properly. (v0.3.2)
  - Auto remove title prefix which is before an underline. (v0.3.2)
  - Fix bug & improve testing. (v0.3.3)

## Any plan?
- ~~Cooperate with Douban Movie or IMDB</strike>~~
- Generate link for Xunlei

## Copyright & License
Copyright © 2013 Janlay Wu <janlay@gmail.com>.

Distributed under the MIT License.
