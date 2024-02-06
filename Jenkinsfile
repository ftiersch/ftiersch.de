pipeline {
  parameters {
    booleanParam(name: 'EXECUTE_TESTS', defaultValue: true, description: 'Run automated tests?')
    booleanParam(name: 'BE_VERBOSE', defaultValue: false, description: 'Be extremely verbose in execution?')
  }

  environment {
      DOMAIN_DIR = "/var/www/vhosts/ftiersch.de"
      RELEASES_DIR = "${DOMAIN_DIR}/releases"
      BUILD_FILE = "ftiersch-build.tar.gz"
      BUILD_DIR = "${WORKSPACE}"
      NUMBERED_DIR = "ftiersch.de${BUILD_NUMBER}"
      PREVIOUS_NUMBERED_DIR = "ftiersch.de${BUILD_NUMBER - 2}"
      CURRENT_SYMLINK = "${DOMAIN_DIR}/current"
      WEB_USER = "www-data"
      WEB_GROUP = "www-data"
      PHP_SERVICE = "php8.3-status"
      PHP_PATH = "php"
      UID = sh (script: 'id -u',returnStdout: true).trim()
      GID = sh (script: 'id -g',returnStdout: true).trim()
      DOCKER_BUILD_COMMAND = './vendor/bin/sail'
  }

  agent any

  stages {
    stage('Checkout') {
      steps {
        script {
          checkout([$class: 'GitSCM', branches: [[name: "master"]], userRemoteConfigs: [[credentialsId: '706765f5-ba24-4cf5-aef1-0d9f4663e022', url: 'https://github.com/ftiersch/ftiersch.de.git/']]])
        }
      }
    }

    stage('Build project') {
      steps {
       sh '${DOCKER_BUILD_COMMAND} up -d'
       sh '${DOCKER_BUILD_COMMAND} composer install'
       sh 'cp .env.build .env'
       sh '${DOCKER_BUILD_COMMAND} artisan key:generate'
       sh '${DOCKER_BUILD_COMMAND} npm install'
       sh '${DOCKER_BUILD_COMMAND} npm run build'
      }
    }

    stage('Run Tests') {
      when {
        expression { params.EXECUTE_TESTS == true }
      }

      steps {
        sh '${DOCKER_BUILD_COMMAND} artisan test'
      }
    }

    stage('Build artifact') {
      steps {
        sh 'touch ${BUILD_FILE}'
        sh 'tar --exclude=${BUILD_FILE} -czf "${BUILD_FILE}" -C "${WORKSPACE}" .'
      }
    }

    stage('Deploy') {
      steps {
        sshPublisher(
          failOnError: true,
          publishers: [
            sshPublisherDesc(
              configName: "ftiersch.de Clouding",
              verbose: BE_VERBOSE,
              transfers: [
                sshTransfer(
                  cleanRemote: false,
                  excludes: '',
                  execCommand: "tar -xzvf ${RELEASES_DIR}/${NUMBERED_DIR}/${BUILD_FILE} -C ${RELEASES_DIR}/${NUMBERED_DIR} . && chmod +x deploy.sh && ./deploy.sh && rm deploy.sh",
                  execTimeout: 120000,
                  flatten: true,
                  makeEmptyDirs: true,
                  noDefaultExcludes: false,
                  patternSeparator: '[, ]+',
                  remoteDirectory: "ftiersch.de/releases/${NUMBERED_DIR}",
                  remoteDirectorySDF: false,
                  sourceFiles: "${BUILD_FILE}"
                )
              ]
            )
          ]
        )
      }
    }
  }

  post {
    always {
      sh 'rm -f *.gz'
      sh 'rm -rf node_modules'
      sh 'rm -rf ${BUILD_FILE}'
      sh '${DOCKER_BUILD_COMMAND} down'
    }
  }
}
