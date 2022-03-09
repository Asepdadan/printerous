pipeline {
  agent any
  stages {
    stage('develope') {
      steps {
        timestamps() {
          sh 'cd'
          echo 'hello bos'
          echo 'hi'
        }

      }
    }

    stage('production') {
      steps {
        echo 'hi prod'
      }
    }

  }
  environment {
    ENV1 = 'TES'
    ENV2 = 'TES LAGI'
  }
}