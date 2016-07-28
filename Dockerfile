FROM index.alauda.cn/axf888/php

MAINTAINER axf <2792938834@qq.com>

COPY . .

RUN /bin/chown www-data:www-data -R /var/www/html/storage /var/www/html/bootstrap/cache

ADD init.sh /init.sh
ADD phptest.sh /phptest.sh
RUN chmod +x /init.sh
RUN chmod +x /phptest.sh

CMD ["/init.sh"]
