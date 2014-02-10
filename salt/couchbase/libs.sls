# Install couchbase libraries
# We use here couchbase repository for ubuntu oneiric, which works fine with debian wheezy

couchbase-oneiric:
  pkgrepo.managed:
    - humanname: Couchbase - Ubuntu Oneiric repo 
    - name: deb http://packages.couchbase.com/ubuntu oneiric oneiric/main
    - file: /etc/apt/sources.list.d/couchbase.list
    - key_url: http://packages.couchbase.com/ubuntu/couchbase.key
    - require_in:
      - pkg: libcouchbase-dev
      - pkg: libcouchbase2-libevent

install libraries:
  pkg.installed:
    - fromrepo: couchbase-oneiric
    - pkgs:
      - libcouchbase-dev
      - libcouchbase2-core
      - libcouchbase2-libevent
