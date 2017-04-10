import React from 'react';
import CatalogItemLayout from '../CatalogItemLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Ноутбуки',
                link: '/notebooks'
            },
            {
                title: this.props.params.brand,
                link: this.props.location.pathname
            }
        ]);

        this.props.handleNotebookGet({
           brand: this.props.params.brand,
           model: this.props.params.model,
           config: this.props.location.query.config
        });
    }

    render() {
        return (
            <div>
                <CatalogItemLayout {...this.props}/>
            </div>
        )
    }
}
