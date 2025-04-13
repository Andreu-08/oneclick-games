#!/bin/bash

cd backend_oc
composer install


cd ../frontend_oc
npm install


PROJECT_NAME=$(basename "$PWD")


if ! grep -q "alias run_back=" ~/.bashrc; then
  echo "alias run_back='cd /workspaces/$PROJECT_NAME/backend_oc && php artisan serve --host=0.0.0.0 --port=8000'" >> ~/.bashrc
fi


if ! grep -q "alias run_front=" ~/.bashrc; then
  echo "alias run_front='cd /workspaces/$PROJECT_NAME/frontend_oc && npm run dev'" >> ~/.bashrc
fi


source ~/.bashrc


echo ""
echo "✅ Proyecto preparado correctamente."
echo ""
echo "Comandos disponibles:"
echo " - run_back  → Levanta el servidor Laravel (backend)"
echo " - run_front → Levanta el servidor Vue (frontend)"
